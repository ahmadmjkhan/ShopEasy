<?php

use App\Models\Order;
use App\Models\Product;

$getOrderStatus = Order::getOrderStatus($orderDetails['id']);
?>
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
                @if($getOrderStatus=="New")



                <button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal" data-target="#ordercancelmodal">
                    Cancel Order
                </button>



                @endif

                @if($getOrderStatus=="Delivered")

                <button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal" data-target="#orderreturnmodal">
                    Return/Exchange Order
                </button>
                @endif
                @if(Session::has('success_message'))

                <div class="alert alert-success">
                    {{Session::get('success_message')}}
                </div>
                @endif
                @if(Session::has('error_message'))

                <div class="alert alert-danger">z
                    {{Session::get('error_message')}}
                </div>
                @endif
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
                        <td>Shipping charges</td>
                        <td>Rs.{{$orderDetails['shipping_charges']}}</td>
                    </tr>

                    <tr>
                        <td>Gst charges</td>
                        <td>Rs.{{$orderDetails['gst_charges']}}</td>
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
                        <th>Item Status</th>
                    </tr>
                    @foreach($orderDetails['order_products'] as $product)

                    <tr>
                        <td>{{$product['product_code']}}</td>
                        <td>@php $getProductImage = Product::getProductImages($product['product_id']) @endphp <a href="{{route('product_details',$product['product_id'])}}"><img style="width: 80px;" src="{{asset('uploads/catalogue-images/products/small/'.$getProductImage)}}" alt=""></a></td>
                        <td>{{$product['product_name']}}</td>
                        <td>{{$product['product_size']}}</td>
                        <td>{{$product['product_color']}}</td>
                        <td>{{$product['product_quantity']}}</td>
                        <td>{{$product['item_status']}}</td>
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
                        <td>{{$orderDetails['address']}}</td>
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

<!-- Button to Open the Modal -->


<!-- The Cancel Order Modal -->
<div class="modal" id="ordercancelmodal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{route('user.orderCancel',$orderDetails['id'])}}" method="post">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reason For Cancellation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <select name="reason" id="cancelReason" class="form-control">
                        <option value="">Select Reason</option>
                        <option value="Order Created By Mistake">Order Created By Mistake</option>
                        <option value="Order Not Arrive On Time">Order Not Arrive On Time</option>
                        <option value="Shipping Cost Too High">Shipping Cost Too High</option>
                        <option value="Found Chesper SomeWhere Else">Found Chesper SomeWhere Else</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm btnCancelOrder">Cancel Order</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- The Return Order Modal -->
<div class="modal" id="orderreturnmodal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{route('user.orderReturn',$orderDetails['id'])}}" method="post">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reason For Return/Exchange</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->

                

                <div class="modal-body">
                    <select name="return_exchange" id="returnExchange" class="form-control">
                        <option value="">Select Return/Exchange</option>
                        <option value="Return">Return</option>
                        <option value="Exchange">Exchange</option>
                    </select>
                </div>

                <div class="modal-body">
                    <select name="product_info" id="returnProduct" class="form-control">
                        <option value="">Select Product</option>
                        @foreach($orderDetails['order_products'] as $product)
                        @if($product['item_status']!="Return Initiated")
                        <option value="{{$product['product_code']}}-{{$product['product_size']}}">{{$product['product_code']}}-{{$product['product_size']}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div class="modal-body productSizes">
                    <select name="required_size" id="productSize" class="form-control">
                        <option value="">Select Required Size</option>
                        
                    </select>
                </div>


                <div class="modal-body">
                    <select name="return_reason" id="returnReason" class="form-control">
                        <option value="">Select Reason</option>
                        <option value="Performance or Quality not adequate">Performance or Quality not adequate</option>
                        <option value="Product got Damaged">Product got Damaged</option>
                        <option value="Item Arrive Too Late">Item Arrive Too Late</option>
                        <option value="Wrong Item Was Sent">Wrong Item Was Sent</option>
                        <option value="Item Defective or doesn't work">Item Defective or doesn't work</option>
                        <option value="Require Smaller Size">Require Smaller Size</option>
                        <option value="Require Larger Size">Require Larger Size</option>
                        <option value="Other">Other</option>
                    </select>
                </div>



                <div class="modal-body">
                    <textarea name="comment" id="" cols="10" rows="3" placeholder="Comment" class="form-control"></textarea>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm btnReturnOrder">Return Order</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection