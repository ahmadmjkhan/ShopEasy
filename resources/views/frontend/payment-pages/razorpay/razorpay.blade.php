<?php

use App\Models\Products; ?>
@extends('frontend.layouts.frontend-master-layout')


@section('content')





<div class="shadow-sm py-3 mb-4 bg-warning border-top">
    <h6 class="mb-0">
        <a href="{{url('/')}}">Home/</a>

        <a href="{{url('cart')}}">Payment</a>
    </h6>
</div>
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60 ">

    <div class="container ">


        <h3>Please Make payment for your Order</h3>
        <form action="{{route('user.payment.makePayment')}}" method="post" class="razorpay_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="amount" value="{{round(Session::get('grand_total'))}}">
            <!-- <input type="submit" class="btn btn-primary" value="Checkout with Paypal"> -->
            <!-- PayPal Logo -->




            <input type="image" src="{{asset('uploads/razorpay-icon.png')}}">


        </form>




    </div>
</div>





@endsection