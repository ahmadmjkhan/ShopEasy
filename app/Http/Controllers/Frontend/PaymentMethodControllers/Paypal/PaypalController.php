<?php

namespace App\Http\Controllers\Frontend\PaymentMethodControllers\Paypal;

use App\Models\Cart;


use Omnipay\Omnipay;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecretKey(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }
    public function paypal()
    {
        if (Session::has('order_id')) {
            return view('frontend.payment-pages.paypal.paypal');
        } else {
            return redirect('cart');
        }
    }

    public function pay(Request $request)
    {
        try {
            $paypal_amount = round(Session::get('grand_total') / 80, 2);
            $response = $this->gateway->purchase(array(
                'amount' => $paypal_amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('user.success'),
                'cancelUrl' => route('user.error')
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function success(Request $request)
    {
        if (!Session::has('order_id')) {
            return redirect('user/shop-cart');
        }

        if ($request->input('paymentId') && $request->input('PayerID')) {

            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();
            if ($response->isSuccessful()) {

                $arr = $response->getData();
                $payment = new Payment();
                $payment->order_id = Session::get('order_id');
                $payment->user_id = Auth::user()->id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();
                // return "payment is Successful Your Transaction".$arr['id'];

                //Update the Order//
                $order_id = Session::get('order_id');

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
                foreach($orderDetails['order_products'] as $key => $order) {
                $getProductStock = ProductAttribute::getProductStock($order['product_id'], $order['product_size']);
                $newstock = $getProductStock - $order['product_quantity'];
                ProductAttribute::where(['product_id' => $order['product_id'], 'size' => $order['product_size']])->update(['stock' => $newstock]);
                }

                //Empty The Cart//
                Cart::where('user_id', Auth::user()->id)->delete();
                return view('frontend.payment-pages.paypal.success-thanks');
            } else {
                return $response->getMessage();
            }
        } else {
            return "Payment Declined";
        }
    }

    public function error(Request $request)
    {
        return view('frontend.payment-pages.paypal.fail-payment');
    }
}
