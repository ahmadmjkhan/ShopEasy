<?php

namespace App\Http\Controllers\Backend\AdminOperations\AdminOrders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderLog;
use App\Models\AdminRole;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\ReturnRequest;
use App\Models\ExchangeRequest;
use App\Models\OrderItemStatus;
use App\Models\Product_Ordered;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function orders()
    {

        //Set Admin/Subadmin for Category //

        $orderModuleCount = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'orders'])->count();
        if(Auth::guard('admin')->user()->type=='SuperAdmin'){
            $orderModule['view_access'] =1;
            $orderModule['edit_acccess'] =1;
            $orderModule['full_access'] =1;
        }elseif($orderModuleCount==0){
               $message = "This feature is Restricted For You";
               return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $orderModule = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'orders'])->first()->toArray();
        }
        
        $orders = Order::with('order_products')->orderBy('id', 'Desc')->get()->toArray();
        return view('backend.admin.orders.order-index')->with(compact(['orders','orderModule']));
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

    public function returnRequests()
    {
        $return_requests = ReturnRequest::get()->toArray();

        return view('backend.admin.orders.return-order')->with(compact('return_requests'));
    }

    public function exchangeRequests()
    {
        $exchange_request = ExchangeRequest::get()->toArray();

        return view('backend.admin.orders.exchange-order')->with(compact('exchange_request'));
    }

    public function returnRequestsUpdate(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $returnDetails = ReturnRequest::where('id', $data['return_id'])->first()->toArray();

            ReturnRequest::where('id', $data['return_id'])->update(['return_status' => $data['return_status']]);

            //Update Return Status in Product Ordered Table//
            Product_Ordered::where(['order_id' => $returnDetails['order_id'], 'product_code' => $returnDetails['product_code'], 'product_size' => $returnDetails['product_size']])->update(['item_status' => 'Return ' . $data['return_status']]);

            //Get User Details//
            $userDetails = User::select('name', 'email')->where('id', $returnDetails['user_id'])->first()->toArray();

            $email = $userDetails['email'];
            $return_status = $data['return_status'];
            $messageData = ['userDetails' => $userDetails, 'returnDetails' => $returnDetails, 'return_status' => $return_status];
            Mail::send('email-pages.return_request', $messageData, function ($message) use ($email, $return_status) {
                $message->to($email)->subject('Return Request ' . $return_status);
            });

            $message = "Return Request has been " . $return_status . ' and Email sent to User';
            return redirect('admin/return-requests')->with('success_message', $message);
        }
    }

    public function exchangeRequestsUpdate(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $exchangeDetails = ExchangeRequest::where('id', $data['exchange_id'])->first()->toArray();

            ExchangeRequest::where('id', $data['exchange_id'])->update(['exchange_status' => $data['exchange_status']]);

            //Update Exchange Status in Product Ordered Table//
            Product_Ordered::where(['order_id' => $exchangeDetails['order_id'], 'product_code' => $exchangeDetails['product_code'], 'product_size' => $exchangeDetails['product_size']])->update(['item_status' => 'Exchange ' . $data['exchange_status']]);

            //Get User Details//
            $userDetails = User::select('name', 'email')->where('id', $exchangeDetails['user_id'])->first()->toArray();

            //Send Email To User //
            $email = $userDetails['email'];
            $exchange_status = $data['exchange_status'];
            $messageData = ['userDetails' => $userDetails, 'exchangeDetails' => $exchangeDetails, 'exchange_status' => $exchange_status];
            Mail::send('email-pages.exchange_request', $messageData, function ($message) use ($email, $exchange_status) {
                $message->to($email)->subject('Exchange Request ' . $exchange_status);
            });

            $message = "Exchange Request has been " . $exchange_status . ' and Email sent to User';
            return redirect('admin/exchange-requests')->with('success_message', $message);
        }
    }
}
