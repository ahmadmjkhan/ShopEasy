<?php

namespace App\Http\Controllers\Backend\SellerOperations\SellerOrders;

use App\Models\User;
use App\Models\Order;


use App\Models\OrderLog;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\OrderItemStatus;
use App\Http\Controllers\Controller;
use App\Models\Product_Ordered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SellerOrderController extends Controller
{
    public function orders()
    {
        $seller_id =  Auth::guard('seller')->user()->id;
        $orders = Order::with(['order_products' => function ($query) use ($seller_id) {
            $query->where('seller_id', $seller_id);
        }])->orderBy('id', 'Desc')->get()->toArray();
        //   dd($orders);
        return view('backend.seller.orders.seller-orders')->with(compact('orders'));
    }

    public function orderSellerDetails($id)
    {
        $orderDetails = Order::with(['order_products' => function ($query) {
            $query->where('seller_id', Auth::guard('seller')->user()->id);
        }])->where('id', $id)->first()->toArray();

        $userDetails  = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $orderStatus = OrderStatus::where('status', '1')->get()->toArray();
        $orderItemStatus = OrderItemStatus::where('status', '1')->get()->toArray();

        // Calculate Item Discount //
        $total_items = 0;
        foreach($orderDetails['order_products'] as $product){
            $total_items = $total_items + $product['product_quantity'];
        }

        //Caluclate Item Discount //
        if($orderDetails['coupon_amount']>0){
            $item_discount = round($orderDetails['coupon_amount']/$total_items,2);
        }else{
           $item_discount = 0;
        }
        return view('backend.seller.orders.seller-order-details')->with(compact(['orderDetails', 'userDetails', 'orderStatus', 'orderItemStatus','item_discount']));
    }

    public function updateOrderItemStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            //Update Order Status //
            Product_Ordered::where('id', $data['order_item_id'])->update(['item_status' => $data['order_item_status']]);

            //Update courier name and tracking number//
            if (!empty($data['item_courier_name']) && !empty(['tracking_number'])) {
                Product_Ordered::where('id', $data['order_item_id'])->update(['courier_name' => $data['item_courier_name'], 'tracking_number' => $data['item_tracking_number']]);
            }

            $getOrderId = Product_Ordered::select('order_id')->where('id', $data['order_item_id'])->first()->toArray();

            //Update Order Log//
            $log = new OrderLog();
            $log->order_id = $getOrderId['order_id'];
            $log->order_item_id = $data['order_item_id'];
            $log->order_status = $data['order_item_status'];
            $log->save();

            // Get Delivery Details//
            $deliveryDetails = Order::select('phone', 'email', 'name')->where('id', $getOrderId['order_id'])->first()->toArray();

            $order_item_id = $data['order_item_id'];
            $orderDetails = Order::with(['order_products'=>function($query)use($order_item_id){
                $query->where('id', $order_item_id);

            }])->where('id', $getOrderId['order_id'])->first()->toArray();

            if (!empty($data['item_courier_name']) && !empty(['tracking_number'])) {
                //Send Order Status Update Email //
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $getOrderId['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_item_status'],
                    'courier_name' => $data['item_courier_name'],
                    'tracking_number' => $data['item_tracking_number']
                ];

                Mail::send('email-pages.order_item_status', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Status Updated - ShopEasy.com');
                });
            } else {
                //Send Order Status Update Email //
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $getOrderId['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_item_status']
                ];

                Mail::send('email-pages.order_item_status', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Status Updated - ShopEasy.com');
                });
            }

            $message = "Order Item Status has Been Updated SuccessFully!";
            return redirect()->back()->with('success_message', $message);
        }
    }
}
