<?php

use App\Models\Products; ?>
@extends('frontend.layouts.frontend-master-layout')


@section('content')





<div class="shadow-sm py-3 mb-4 bg-warning border-top">
    <h6 class="mb-0">
        <a href="{{url('/')}}">Home/</a>

        <a href="{{url('cart')}}">Cart</a>
    </h6>
</div>
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60 ">

    <div class="container ">

        
      <h3>Your Order Have Been Placed SuccessFully</h3>
      <p>Your Order Number is {{Session::get('order_id')}} and Grand Total id INR {{Session::get('grand_total')}}</p>




    </div>
</div>


@endsection