<?php

namespace App\Http\Controllers\Backend\AdminOperations\AdminOrders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderLog;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\OrderItemStatus;
use App\Models\Product_Ordered;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function orders()
    {
        $orders = Order::with('order_products')->orderBy('id', 'Desc')->get()->toArray();
        return view('backend.admin.orders.order-index')->with(compact('orders'));
    }

    public function orderDetails($id)
    {
        $orderDetails = Order::with('order_products')->where('id', $id)->first()->toArray();
        $userDetails  = User::where('id', $orderDetails['user_id'])->first()->toArray();
        $orderStatus = OrderStatus::where('status', '1')->get()->toArray();
        $orderItemStatus = OrderItemStatus::where('status', '1')->get()->toArray();
        $orderLog = OrderLog::with('order_products')->where('order_id', $id)->orderBy('id', 'Desc')->get()->toArray();


        // Calculate Item Discount //
        $total_items = 0;
        foreach ($orderDetails['order_products'] as $product) {
            $total_items = $total_items + $product['product_quantity'];
        }

        //Caluclate Item Discount //
        if ($orderDetails['coupon_amount'] > 0) {
            $item_discount = round($orderDetails['coupon_amount'] / $total_items, 2);
        } else {
            $item_discount = 0;
        }

        return view('backend.admin.orders.order-details')->with(compact(['orderDetails', 'userDetails', 'orderStatus', 'orderItemStatus', 'orderLog', 'item_discount']));
    }

    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            //Update Order Status //
            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);

            //Update courier name and tracking number//
            if (!empty($data['courier_name']) && !empty(['tracking_number'])) {
                Order::where('id', $data['order_id'])->update(['courier_name' => $data['courier_name'], 'tracking_number' => $data['tracking_number']]);
            }

            //Update Order Log//
            $log = new OrderLog();
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();



            // Get Delivery Details//
            $deliveryDetails = Order::select('phone', 'email', 'name')->where('id', $data['order_id'])->first()->toArray();
            $orderDetails = Order::with('order_products')->where('id', $data['order_id'])->first()->toArray();

            if (!empty($data['courier_name']) && !empty(['tracking_number'])) {
                //Send Order Status Update Email //
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $data['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_status'],
                    'courier_name' => $data['courier_name'],
                    'tracking_number' => $data['tracking_number']
                ];

                Mail::send('email-pages.order_status', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Status Updated - ShopEasy.com');
                });
            } else {
                //Send Order Status Update Email //
                $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $data['order_id'],
                    'orderDetails' => $orderDetails,
                    'order_status' => $data['order_status']
                ];

                Mail::send('email-pages.order_status', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Status Updated - ShopEasy.com');
                });
            }

            $message = "Order Status has Been Updated SuccessFully!";
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function updateOrderItemStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            //Update Order Item Status //
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
            $orderDetails = Order::with('order_products')->where('id', $getOrderId['order_id'])->first()->toArray();


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

                Mail::send('email-pages.order_status', $messageData, function ($message) use ($email) {
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

                Mail::send('email-pages.order_status', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Status Updated - ShopEasy.com');
                });
            }

            $message = "Order Item Status has Been Updated SuccessFully!";
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function viewOrderInvoice($order_id)
    {
        $orderDetails = Order::with('order_products')->where('id', $order_id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();
        return view('backend.admin.orders.order-invoice')->with(compact('orderDetails', 'userDetails'));
    }

    public function viewOrderPdfInvoice($order_id)
    {
        $orderDetails = Order::with('order_products')->where('id', $order_id)->first()->toArray();
        $userDetails = User::where('id', $orderDetails['user_id'])->first()->toArray();

        // instantiate and use the dompdf class
        // $dompdf = new Dompdf();
        // $dompdf->loadHTMl('hello world');

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        // $dompdf->render();

        // Output the generated PDF to Browser
        // $dompdf->stream();
        // return view('admin.orders.order-invoice')->with(compact('orderDetails', 'userDetails'));
        view()->share(['orderDetails' => $orderDetails, 'userDetails' => $userDetails]);
        $pdf = Pdf::loadView('backend.admin.orders.pdf-order-invoice', $orderDetails)->setPaper('a4', 'landscape')->setWarnings(false)->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // return $pdf->download('invoice.pdf');
        return $pdf->stream();
    }
}
