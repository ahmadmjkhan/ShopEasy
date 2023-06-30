<?php

use App\Models\Product; ?>
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
            <div class="col-md-12">
                <table class="table table-stripped">
                    <tr>
                        <td colspan="2" class="table-primary"><strong>Order Details</strong></td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td>{{date('Y-m-d h:i:s',strtotime($orderDetails['created_at']))}}</td>
                    </tr>

                    <tr>
                        <td>Order Status</td>
                        <td>{{$orderDetails['order_status']}}</td>
                    </tr>
                    <tr>
                        <td>Order Total</td>
                        <td>Rs.{{$orderDetails['grand_total']}}</td>
                    </tr>
                    <tr>
                        <td>Shipping_charges</td>
                        <td>Rs.{{$orderDetails['shipping_charges']}}</td>
                    </tr>
                    @if($orderDetails['coupon_code']!="")
                    <tr>
                        <td>Coupon Code</td>
                        <td>{{$orderDetails['coupon_code']}}</td>
                    </tr>
                    <tr>
                        <td>Coupon Amount</td>
                        <td>Rs.{{$orderDetails['coupon_amount']}}</td>
                    </tr>
                    @endif
                    @if($orderDetails['courier_name']!="")
                    <tr>
                        <td>Courier Name</td>
                        <td>{{$orderDetails['courier_name']}}</td>
                    </tr>
                    <tr>
                        <td>Tracking Number</td>
                        <td>Rs.{{$orderDetails['tracking_number']}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Payment Method</td>
                        <td>{{$orderDetails['payment_method']}}</td>
                    </tr>
                </table>


                <table class="table table-stripped">
                    <tr>
                        <td colspan="2" class="table-primary"><strong>Product Details</strong></td>
                    </tr>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Quantity</th>
                    </tr>
                    @foreach($orderDetails['order_products'] as $product)

                    <tr>
                        <td>{{$product['product_code']}}</td>
                        <td>@php $getProductImage = Product::getProductImages($product['product_id']) @endphp <a href="{{route('product_details',$product['product_id'])}}"><img style="width: 80px;" src="{{asset('uploads/catalogue-images/products/small/'.$getProductImage)}}" alt=""></a></td>
                        <td>{{$product['product_name']}}</td>
                        <td>{{$product['product_size']}}</td>
                        <td>{{$product['product_color']}}</td>
                        <td>{{$product['product_quantity']}}</td>
                    </tr>
                    @if($product['courier_name']!="")
                    <tr>
                        <td colspan="6">Courier Name:{{$product['courier_name']}},Tracking Number:{{$product['tracking_number']}}</td>
                    </tr>
                    @endif
                    @endforeach
                </table>



                <table class="table table-striped table-borderless">
                    <tr>
                        <td colspan="2" class="table-danger"><strong>Delivery Address</strong></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>{{$orderDetails['name']}}</td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td>{{$orderDetails['address']}}}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{$orderDetails['city']}}</td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>{{$orderDetails['state']}}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{$orderDetails['country']}}</td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td>{{$orderDetails['pincode']}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{$orderDetails['phone']}}</td>
                    </tr>
                </table>
            </div>

        </div>




    </div>
</div>


@endsection