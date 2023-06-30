@extends('frontend.layouts.frontend-master-layout')

@section('content')
<?php

use App\Models\Product; ?>


<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="coupon-accordion">
                    <!--Accordion Start-->
                    <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                    <div id="checkout-login" class="coupon-content">
                        <div class="coupon-info">
                            <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
                            <form action="#">
                                <p class="form-row-first">
                                    <label>Username or email <span class="required">*</span></label>
                                    <input type="text">
                                </p>
                                <p class="form-row-last">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="text">
                                </p>
                                <p class="form-row">
                                    <input value="Login" type="submit">
                                    <label>
                                        <input type="checkbox">
                                        Remember me
                                    </label>
                                </p>
                                <p class="lost-password"><a href="#">Lost your password?</a></p>
                            </form>
                        </div>
                    </div>
                    <!--Accordion End-->
                    <!--Accordion Start-->
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input placeholder="Coupon code" type="text">
                                    <input value="Apply Coupon" type="submit">

                                </p>
                            </form>
                        </div>
                    </div>
                    <!--Accordion End-->
                </div>
            </div>
        </div>

        @if(Session::has('success_message'))

        <div class="alert alert-success">
            {{Session::get('success_message')}}
        </div>
        @endif
        @if(Session::has('error_message'))

        <div class="alert alert-danger">
            {{Session::get('error_message')}}
        </div>
        @endif



        <div class="row">

            <div class="col-lg-6 col-12" id="deliveryAddresses">
                @include('frontend.cart-pages.add-delivery-address')

            </div>

            <div class="col-lg-6 col-12">

                <form action="{{route('user.checkout-page')}}" method="post" id="checkoutform" name="checkoutForm">
                    @csrf
                    @if(count($deliveryAddresses)>0)

                    <h3>Delivery Addresses</h3>
                    @foreach($deliveryAddresses as $address)

                    <div style="float:left;margin-right:10px;"><input type="radio" id="address{{$address['id']}}" name="address_id" value="{{$address['id']}}" shipping_charges="{{$address['shipping_charges']}}" total_price="{{$total_price}}" coupon_amount="{{Session::get('couponAmount')}}" codpincodeCount="{{$address['codpincodeCount']}}" prepaidpincodeCount="{{$address['prepaidpincodeCount']}}"></div>
                    <div>
                        <label><b>{{$address['name']}},{{$address['address']}}<br>{{$address['city']}},{{$address['state']}},{{$address['country']}},({{$address['phone']}})</b></label>
                        <a style="float:right" href="javascript:;" data-addressid="{{$address['id']}}" class="editAddress btn btn-sm btn-info text-white ml-2"><i class="fa fa-edit"></i></a>
                        <a style="float:right;" href="javascript:;" data-addressid="{{$address['id']}}" class="removeAddress btn btn-sm btn-danger text-white"><i class="fa fa-trash"></i></a>
                    </div>


                    @endforeach<br>
                    @endif

                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table table-striped ">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="cart-product-name"><b>Product</b></th>
                                        <th class="cart-product-total"><b>Total</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach($getCartItems as $cart)
                                    <?php
                                    $getDiscountAttributePrice = Product::getAttributeDiscountPrice($cart->product_id, $cart->size);
                                    ?>
                                    <tr class="cart_item">

                                        <td class="cart-product-name"> <a href=""> <img src="{{asset('uploads/images/products/small/'.$cart->product->product_image)}}" width="30" alt=""></a>{{$cart->product->product_name}}<strong class="product-quantity"> × {{$cart->quantity}}</strong></td>
                                        <td class="cart-product-total"><span class="amount">₹{{$getDiscountAttributePrice['final_price'] * $cart->quantity}}</span></td>
                                    </tr>
                                    @php $total = $total + ($getDiscountAttributePrice['final_price'] * $cart->quantity)
                                    @endphp
                                    @endforeach

                                </tbody>
                                <tfoot>

                                    <tr class="cart-subtotal table-primary">
                                        <th><b>Cart Subtotal</b></th>
                                        <td><span class="amount"><b>₹{{$total}}</b></span></td>
                                    </tr>

                                    <tr>


                                        <th>Shipping Charges</th>
                                        <td><span class="amount shipping_charges">₹ 0 </span></td>
                                    </tr>

                                    <tr>

                                        <th>Coupon Discount</th>
                                        <td><span class="amount"> @if(Session::has('couponAmount'))
                                                <span class="couponAmount">₹ {{Session::get('couponAmount')}}</span>
                                                @else
                                                ₹ 0
                                                @endif</span></td>

                                    </tr>

                                    <tr class="order-total table-primary">
                                        <th>Grand Total</th>
                                        <td><strong><span class="amount grand_total">₹ {{$total - Session::get('couponAmount')}}</span></strong></td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <!-- <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="#payment-1">
                                            <h5 class="panel-title">
                                                <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Direct Bank Transfer.
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                    <div class="card-header" id="#payment-2">
                                        <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                               Cash on Delivery
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="#payment-3">
                                        <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                PayPal
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>


                                </div> -->


                                <div style="float:left;margin-right:10px;" class="codMethod">
                                    <input type="radio" id="cash-on-delivery" name="payment_gateway" value="COD" style="width: 20px;">
                                    <label for="">Cash On Delivery</label>
                                </div>


                                <div style="float:left;margin-right:10px;" class="prepaidMethod">
                                    <input type="radio" id="paypal" name="payment_gateway" value="Paypal" style="width: 20px;">
                                    <label for="">Paypal</label>
                                </div>


                                <div class="order-button-payment">
                                    <input value="Place order" type="submit">
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!--Checkout Area End-->



@endsection