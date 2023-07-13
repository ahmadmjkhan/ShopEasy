<?php

namespace App\Http\Controllers\Frontend\PaymentMethodControllers\RazorPay;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RazorPayController extends Controller
{
    public $api;
    public function __construct($foo = null)
    {
        $this->api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }
    public function showPaymentForm()
    { {
            if (Session::has('order_id')) {
                return view('frontend.payment-pages.razorpay.razorpay');
            } else {
                return redirect('cart');
            }
        }
    }
    public function makePayment(Request $request)
    {



        if ($request->isMethod('post')) {
            $razorpay_amount = round(Session::get('grand_total'));
            $order = $this->api->order->create([
                'amount' => $razorpay_amount,
                'currency' => env('RAZORPAY_CURRENCY'),

            ]);

            if ($order) {
                return response()->json([
                    'amount' => $order->amount,
                    'user_id' => Auth::user()->id,
                    'currency'=>$order->currency,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'contact' => Auth::user()->phone,
                    'order_id' => Session::get('order_id'),
                    'key' => env('RAZORPAY_KEY'),
                    'status' => '1',

                ]);
            } else {
                echo "Erroro Parf";
            }
        }

        // $orderId = $order['id'];
        // return view('razorpay', compact('orderId'));



        // if ($request->isMethod('post')) {
        //     $data = $request->all();


        //     $razorpayOrder = $this->api->payment->fetch($data['razorpay_payment_id']);
        //     dd($razorpayOrder);

        //     if (count($data) && !empty($data['razorpay_payment_id'])) {

        //         try {
        //             $response = $this->api->payment->fetch($data['razorpay_payment_id'])->capture(array('amount' => $data['amount'], 'currency' => 'INR'));
        //         } catch (Exception $e) {
        //             return $e->getMessage();
        //             return redirect()->back();
        //         }

        //         // return redirect()->route('user.payment.success');
        //         return response()->json([
        //             'data'=>$response,
        //         ]);
        //     } else {
        //         return $razorpayOrder->getMessage();
        //     }

        // $input = $request->all();
        //  dd($input);


        // $razorpayOrder = $this->api->payment->fetch($input['razorpay_payment_id']);
        // dd($razorpayOrder);

        // if(count($input) && !empty($input['razorpay_payment_id'])){

        //     try{
        //         $response = $this->api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$razorpayOrder['amount'],'currency'=>$razorpayOrder['currency']));
        //     }catch(Exception $e){
        //       return $e->getMessage();
        //       return redirect()->back();
        //     }

        //     return redirect()->route('user.payment.success');
        // } else {
        //     return $razorpayOrder->getMessage();
        // }



    }
    public function paymentSuccess(Request $request)
    {
        if (!Session::has('order_id')) {
            return redirect('user/shop-cart');
        }

        if ($request->input('payment_id')) {
            // $data = $request->input();
            // echo "<pre>";print_r($data);die;


            $payment = new Payment();
            $payment->order_id = $request->input('order_id');
            $payment->user_id = $request->input('user_id');
            $payment->payment_id = $request->input('payment_id');
            // $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
            $payment->payer_email = $request->input('payer_email');
            $payment->amount = $request->input('amount');
            $payment->currency = $request->input('currency');
            $payment->payment_status = $request->input('payment_status');
            $payment->save();
            // return "payment is Successful Your Transaction".$arr['id'];

            //Update the Order//
            $order_id = $request->input('order_id');

            //update order status to paid//
            Order::where('id', $order_id)->update(['order_status' => 'Paid']);

            $orderDetails = Order::with('order_products')->where('id', $order_id)->first()->toArray();

            //Send Order Email//
            $email = Auth::user()->email;
            $messageData = [
                'email' => $email,
                'name' => Auth::user()->name,
                'order_id' => $order_id,
                'orderDetails' => $orderDetails
            ];

            Mail::send('email-pages.order', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Order Placed - ShopEasy.com');
            });

            //Reduce Stock Scripts Starts//
            foreach ($orderDetails['order_products'] as $key => $order) {
                $getProductStock = ProductAttribute::getProductStock($order['product_id'], $order['product_size']);
                $newstock = $getProductStock - $order['product_quantity'];
                ProductAttribute::where(['product_id' => $order['product_id'], 'size' => $order['product_size']])->update(['stock' => $newstock]);
            }

            //Empty The Cart//
            Cart::where('user_id', Auth::user()->id)->delete();

            return response()->json([
                'message' => 'Payment Successful to ShopEasy',
                'redirect_url' => route('user.payment.success.thanks')
            ]);
        } else {
            return "Payment Declined";
        }
    }


    public function thanks_success()
    {
        return view('frontend.payment-pages.razorpay.payment-success');
    }
    public function paymentFailure()
    {
        return view('payment-failure');
    }
}
