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

    <div class="container">


        <div id="appendCartItems">
            @include('frontend.cart-pages.append-cart-items')
        </div>


    

    </div>



</div>

<!--Shopping Cart Area End-->

@endsection