<?php

use App\Models\Products; ?>
@extends('frontend.layouts.frontend-master-layout')

@section('content')





<div class="shadow-sm py-3 mb-4 bg-warning border-top">
    <h6 class="mb-0">
        <a href="{{url('/')}}">Home/</a>

        <a href="{{url('cart')}}">My Orders</a>
    </h6>
</div>
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60 ">

    <div class="container ">

        
      <div class="row">
         <table class="table table-striped table-borderless">
              <tr>
                <th>Order ID</th>
                <th>Order Products</th>
                <th>Payment Methods</th>
                <th>Grand Total</th>
                <th>Created On</th>
               

              </tr>

              @foreach($orders as $order)
              <tr>
                      <td><a href="{{route('user.your-orders',$order['id'])}}">{{$order['id']}}</a></td>
                      <td>
                        @foreach($order['order_products'] as $product)
                            {{$product['product_code']}}<br>
                        @endforeach
                      </td>
                      <td>{{$order['payment_method']}}</td>
                      <td>{{$order['grand_total']}}</td>
                      <td>{{date('Y-m-d h:i:s',strtotime($order['created_at']))}}</td>
              </tr>
              @endforeach
         </table>
      </div>




    </div>
</div>


@endsection