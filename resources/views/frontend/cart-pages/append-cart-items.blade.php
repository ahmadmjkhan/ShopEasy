<?php

use App\Models\Product; ?>

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

<div class="row cartitem-reload">

    @if($getCartItems->count()>0)
    <div class="col-md-8">

        <div class="card shadow mt-3">

            <div class="card-body">

                @php $total = 0; @endphp
                @foreach($getCartItems as $cart)
                <?php
                $getDiscountAttributePrice = Product::getAttributeDiscountPrice($cart->product_id, $cart->size);
                ?>
                <div class="row product-data">

                    <div class="col-md-2 border-right">
                        <img src="{{asset('uploads/catalogue-images/products/small/'.$cart->product->product_image)}}" class="w-100" alt="">
                    </div>

                    <div class="col-md-3">

                        <h5 class="mb-0">
                            {{$cart->product->product_name}}
                        </h5>
                        <p> Seller: Seller Name</p>
                        @if($getDiscountAttributePrice['discount']>0)

                        <span class="text-danger h6"><b>₹{{$getDiscountAttributePrice['final_price']}}</b></span>
                        <s><span class="text-primary">{{$getDiscountAttributePrice['product_price']}}</span></s>
                        @else
                        <td class="li-product-price"><span class="amount">₹{{$getDiscountAttributePrice['final_price']}}</span></td>
                        @endif
                    </div>



                    <div class="col-md-3">
                        <input type="hidden" value="{{$cart->product_id}}" class="prod_id">

                        <label for="">Quantity </label>
                        <div class="input-group text-center mb-3">

                            <button class="input-group-text changeQuantity decreament_btn" data-id="{{$cart->id}}" data-qty="{{$cart->quantity}}">-</button>
                            <input type="text" name="quantity" value="{{$cart->quantity}}" class="form-control qty_input" />
                            <button class="input-group-text changeQuantity increament_btn" data-id="{{$cart->id}}" data-qty="{{$cart->quantity}}">+</button>

                        </div>

                    </div>

                    <div class="col-md-2 m-auto">
                        <button type="submit" class="btn btn-warning delete-cart-item">Remove</button>
                    </div>

                </div>
                @php $total = $total+($getDiscountAttributePrice['final_price'] * $cart->quantity)
                @endphp
                @endforeach

            </div>

        </div>


        <div class="coupon-all mb-5">
            <div class="coupon">
                <form action="javascript:void(0);" id="ApplyCoupon" method="post" @if(Auth::check()) user="1" @endif>
                    @csrf
                    <input id="code" class="input-text" name="code" value="" placeholder="Coupon code" type="text">
                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                    <div class="success_message text-success mt-2" style="display:none;"></div>
                    <div class="error_message text-danger mt-2" style="display:none;"></div>
                </form>
            </div>
            <!-- <div class="coupon2">
                    <input class="button" name="update_cart" value="Update cart" type="submit">
                </div> -->
        </div>




    </div>

    <div class="col-md-4">

        <div class="card shadow mt-3">
            <div class="cart-page-total">
                <h2 class="text-center">Price Total</h2>
                <ul>
                    <li>Sub Total:<span>Rs.{{$total}}</span></li>
                    <li>Coupon Discount:<span class="couponAmount">
                            @if(Session::has('couponAmount'))
                            Rs. {{Session::get('couponAmount')}}
                            @else
                            Rs.0
                            @endif
                        </span></li>
                    <li><strong>Grand Total </strong><span class="grand_total">Rs.{{$total -Session::get('couponAmount')}}</span></li>
                </ul>
                <a href="{{route('user.checkout-page')}}" class="d-block">Proceed to checkout</a>
            </div>
        </div>
    </div>







    @else

    <div class="card-body text-center">
        <h2>Your <i class="fa fa-shopping-cart"></i> Cart Is Empty</h2>
        <a href="{{route('user.home')}}" class="btnbtn-outline-primary float-end">Continue Shopping</a>
    </div>

    @endif
</div>