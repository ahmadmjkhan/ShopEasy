<?php


use App\Models\Coupon;
use App\Models\Seller;
use App\Models\Product;
use App\Models\OrderLog;
use Illuminate\Support\Facades\Auth;

$getSellerComission = Seller::getSellerComissions(Auth::guard('seller')->user()->id);

?>
@extends('backend.admin.layouts.admin-master-layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>Order #{{$orderDetails['id']}} Details</h4>

        <div class="row mt-3">
            <div class="col-md-6">
                @if(Session::has('success_message'))

                <div class="alert alert-success">
                    {{Session::get('success_message')}}
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Order Details</h4>
                    </div>
                    <div class="card-body">
                        <label for=""><strong>Order Date:</strong></label>
                        <span>{{date('Y-m-d h:i:s',strtotime($orderDetails['created_at']))}}</span><br>

                        <label for=""><strong>Order Status:</strong></label>
                        <span>{{$orderDetails['order_status']}}</span><br>

                        <label for=""><strong>Order Total:</strong></label>
                        <span> ₹ {{$orderDetails['grand_total']}}</span><br>


                        <label for=""><strong>Shipping Charges:</strong></label>
                        <span> ₹ {{$orderDetails['shipping_charges']}}</span><br>

                        @if(!empty($orderDetails['coupon_code']))
                        <label for=""><strong>Coupon Code:</strong></label>
                        <span>{{$orderDetails['coupon_code']}}</span><br>

                        <label for=""><strong>Coupon Amount:</strong></label>
                        <span>{{$orderDetails['coupon_amount']}}</span><br>
                        @endif

                        <label for=""><strong>Payment Method:</strong></label>
                        <span>{{$orderDetails['payment_method']}}</span><br>

                        <label for=""><strong>Payment Gateway:</strong></label>
                        <span>{{$orderDetails['payment_gateway']}}</span><br>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Details</h4>
                    </div>
                    <div class="card-body">
                        <label for=""><strong>Name:</strong></label>
                        <span>{{$userDetails['name']}}</span><br>

                        @if(!empty($userDetails['address']))
                        <label for=""><strong>Address:</strong></label>
                        <span>{{$userDetails['address']}}</span><br>
                        @endif
                        @if(!empty($userDetails['city']))
                        <label for=""><strong>City:</strong></label>
                        <span>{{$userDetails['city']}}</span><br>
                        @endif
                        @if(!empty($userDetails['state']))
                        <label for=""><strong>State:</strong></label>
                        <span>{{$userDetails['state']}}</span><br>
                        @endif
                        @if(!empty($userDetails['country']))
                        <label for=""><strong>Country:</strong></label>
                        <span>{{$userDetails['country']}}</span><br>
                        @endif
                        @if(!empty($userDetails['pincode']))
                        <label for=""><strong>Pincode:</strong></label>
                        <span>{{$userDetails['pincode']}}</span><br>
                        @endif
                        <label for=""><strong>Phone:</strong></label>
                        <span>{{$userDetails['phone']}}</span><br>

                        <label for=""><strong>Email:</strong></label>
                        <span>{{$userDetails['email']}}</span><br>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Delivery Address</h4>
                    </div>
                    <div class="card-body">
                        <label for=""><strong>Name:</strong></label>
                        <span>{{$orderDetails['name']}}</span><br>

                        @if(!empty($orderDetails['address']))
                        <label for=""><strong>Address:</strong></label>
                        <span>{{$orderDetails['address']}}</span><br>
                        @endif
                        @if(!empty($orderDetails['city']))
                        <label for=""><strong>City:</strong></label>
                        <span>{{$orderDetails['city']}}</span><br>
                        @endif
                        @if(!empty($orderDetails['state']))
                        <label for=""><strong>State:</strong></label>
                        <span>{{$orderDetails['state']}}</span><br>
                        @endif
                        @if(!empty($orderDetails['country']))
                        <label for=""><strong>Country:</strong></label>
                        <span>{{$orderDetails['country']}}</span><br>
                        @endif
                        @if(!empty($orderDetails['pincode']))
                        <label for=""><strong>Pincode:</strong></label>
                        <span>{{$orderDetails['pincode']}}</span><br>
                        @endif
                        <label for=""><strong>Phone:</strong></label>
                        <span>{{$orderDetails['phone']}}</span><br>

                        <label for=""><strong>Email:</strong></label>
                        <span>{{$orderDetails['email']}}</span><br>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Order Status</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.update-order-status')}}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$orderDetails['id']}}">
                            <select name="order_status" id="order_status" class="form-control">
                                <option value="">Select</option>
                                @foreach($orderStatus as $status)
                                <option value="{{$status['name']}}" @if(!empty($orderDetails['order_status']) && $orderDetails['order_status']==$status['name']) selected="" @endif>{{$status['name']}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="courier_name" id="courier_name" placeholder="Courier Name">
                            <input type="text" name="tracking_number" id="tracking_number" placeholder="Tracking Number">
                            <button type="submit" class="wait-btn">Update</button>
                        </form><br>
                        @foreach($orderLog as $log)
                        <strong>{{$log['order_status']}}</strong>
                        @if(isset($log['order_item_id'])&& $log['order_item_id']>0)
                        @php $getItemDetails = OrderLog::getItemDetails($log['order_item_id']) @endphp
                        -for item {{$getItemDetails['product_code']}}


                        @if(!empty($getItemDetails['courier_name']))
                        <br><span>Courier Name:{{$getItemDetails['courier_name']}}</span>
                        @endif
                        @if(!empty($getItemDetails['tracking_number']))
                        <br><span>Tracking Number:{{$getItemDetails['tracking_number']}}</span>
                        @endif
                        @endif

                        {{date('Y-m-d h:i:s',strtotime($log['created_at']))}}<br>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Ordered Products</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-stripped">

                            <tr>
                                <th class="table-danger">Product Code</th>
                                <th class="table-danger">Product Image</th>
                                <th class="table-danger">Name</th>
                                <th class="table-danger">Size</th>
                                <th class="table-danger">Color</th>
                                <th class="table-danger">Unit Price</th>
                                <th class="table-danger">Product Quantity</th>
                                <th class="table-danger">Total Price</th>
                                <th class="table-danger">Product By</th>
                                <th class="table-danger">Comissions</th>
                                <th class="table-danger">Final Amount</th>
                                <th class="table-danger">Item Status</th>
                            </tr>
                            @foreach($orderDetails['order_products'] as $product)

                            <tr>
                                <td>{{$product['product_code']}}</td>
                                <td>@php $getProductImage = Product::getProductImages($product['product_id']) @endphp <a href="{{route('product_details',$product['product_id'])}}"><img style="width: 80px;" src="{{asset('uploads/catalogue-images/products/small/'.$getProductImage)}}" alt=""></a></td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$product['product_size']}}</td>
                                <td>{{$product['product_color']}}</td>
                                <td>Rs {{$product['product_price']}}</td>
                                <td>{{$product['product_quantity']}}</td>
                               


                                <td>
                                    @if($product['seller_id']>0)
                                    @if($orderDetails['coupon_amount']>0)
                                    @php $couponDetails = Coupon::couponDetails($orderDetails['coupon_code']) @endphp

                                    @if($couponDetails['seller_id']>0)
                                    {{$total_price = $product['product_price']*$product['product_quantity']-$item_discount}}
                                    @else
                                    {{$total_price = $product['product_quantity']*$product['product_price']}}
                                    @endif
                                    @else
                                    {{$total_price = $product['product_quantity']*$product['product_price']}}
                                    @endif
                                    @else
                                    {{$total_price = $product['product_quantity']*$product['product_price']}}
                                    @endif

                                </td>

                                @if($product['seller_id']>0)
                                <td><a href="{{route('admin.view_seller_details',$product['seller_id'])}}">Vendor</td>
                                @else
                                <td>Admin</td>
                                @endif

                                <td>{{$comission = round($total_price * $getSellerComission/100,2)}}</td>
                                <td>{{$total_price - $comission }}</td>
                                <td>
                                    <form action="{{route('admin.update-order-item-status')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_item_id" value="{{$product['id']}}">
                                        <select name="order_item_status" id="order_item_status" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($orderItemStatus as $itemstatus)
                                            <option value="{{$itemstatus['name']}}" @if(!empty($product['item_status']) && $product['item_status']==$itemstatus['name']) selected="" @endif>{{$itemstatus['name']}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="item_courier_name" id="item_courier_name" placeholder="Courier Name" @if(!empty($product['courier_name'])) value="{{$product['courier_name']}}" @endif>
                                        <input type="text" name="item_tracking_number" id="item_tracking_number" placeholder="Tracking Number" @if(!empty($product['tracking_number'])) value="{{$product['tracking_number']}}" @endif>
                                        <button type="submit" class="wait-btn">Update</button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Spinner Area -->

<div id="spinner-container" class="div-container" style="display:none;">
    <svg viewBox="0 0 100 100">
        <defs>
            <filter id="shadow">
                <feDropShadow dx="0" dy="0" stdDeviation="1.5" flood-color="#fc6767" />
            </filter>
        </defs>
        <circle id="spinner" style="fill:transparent;stroke:#dd2476;stroke-width: 7px;stroke-linecap: round;filter:url(#shadow);" cx="50" cy="50" r="45" />
    </svg>
</div>


<!-- spinner Area end -->


@endsection