<?php

use App\Models\Products;
use Illuminate\Support\Facades\Session;
?>
@extends('layouts.frontend-app')


@section('content')





<div class="shadow-sm py-3 mb-4 bg-warning border-top">
    <h6 class="mb-0">
        <a href="{{url('/')}}">Home/</a>

        <a href="{{url('cart')}}">Thanks</a>
    </h6>
</div>
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60 ">

    <div class="container ">


        <h3>Your Payment Has Been Confirmed</h3>
        <p>Thanks For Payment. We will process your Order Soon.</p>
        <p>Your Order Number is {{Session::get('order_id')}} and Grand Total id INR {{Session::get('grand_total')}}</p>




    </div>
</div>


@endsection




<?php
Session::forget('grand_total');
Session::forget('order_id');
Session::forget('couponCode');
Session::forget('couponAmount');

?>