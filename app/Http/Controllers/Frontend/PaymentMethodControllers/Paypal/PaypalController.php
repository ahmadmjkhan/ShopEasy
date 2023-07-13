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
    public function paypal(){
        return view('frontend.payment-pages.paypal.paypal');
    }



    public function pay(Request $request){
        
    }
}
