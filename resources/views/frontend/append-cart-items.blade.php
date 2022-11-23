<?php

use App\Models\Products; ?>

<div class="row cartitem-reload">
    @if($getCartItems->count()>0)
    <div class="col-8">
        <div class="card shadow mt-3">

            <div class="card-body">

                @php $total = 0; @endphp
                @foreach($getCartItems as $cart)
                <div class="row product-data">

                    <div class="col-md-2 border-right">
                        <img src="{{asset('uploads/images/products/small/'.$cart->product->product_image)}}" class="w-100" alt="">
                    </div>

                    <div class="col-md-3">
                        <?php
                        $getDiscountPrice = Products::getDiscountPrice($cart->product_id);

                        ?>
                        <h5 class="mb-0">
                            {{$cart->product->product_name}}
                        </h5>
                        <p> Seller: Seller Name</p>
                        @if($getDiscountPrice>0)

                        <span class="text-danger h6"><b>₹{{$getDiscountPrice}}</b></span>
                        <s><span class="text-primary">{{$cart->product->product_price}}</span></s>
                        @else
                        <td class="li-product-price"><span class="amount">{{$cart->product_price}}</span></td>
                        @endif
                    </div>

                    <!-- <div class="col-md-3">
                            <input type="hidden" value="{{$cart->product_id}}" class="prod_id">

                            <label for="">Quantity </label>
                            <div class="input-group text-center mb-3">

                                <button class="input-group-text changeQuantity decreament_btn">-</button>
                                <input type="text" name="quantity" value="{{$cart->quantity}}" class="form-control qty_input" />
                                <button class="input-group-text changeQuantity increament_btn">+</button>
                                @php $total += $getDiscountPrice * $cart->quantity; @endphp
                            </div>

                        </div> -->

                    <div class="col-md-3">
                        <input type="hidden" value="{{$cart->product_id}}" class="prod_id">

                        <label for="">Quantity </label>
                        <div class="input-group text-center mb-3">

                            <button class="input-group-text changeQuantity decreament_btn" data-id="{{$cart->id}}" data-qty="{{$cart->quantity}}">-</button>
                            <input type="text" name="quantity" value="{{$cart->quantity}}" class="form-control qty_input" />
                            <button class="input-group-text changeQuantity increament_btn" data-id="{{$cart->id}}" data-qty="{{$cart->quantity}}">+</button>
                            @php $total = $getDiscountPrice * $cart->quantity; @endphp
                        </div>

                    </div>

                    <div class="col-md-2 m-auto">
                        <button type="submit" class="btn btn-warning delete-cart-item">Remove</button>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-4">

        <div class="card shadow mt-3">
            <div class="cart-page-total">
                <h2 class="text-center">Price Total</h2>
                <ul>
                    @if(isset($total))
                    <li>Price (6 Items) <span>₹ {{$total}}</span></li>
                    @else
                    <li>Price (6 Items) <span>₹ 0</span></li>
                    @endif
                    <li>Discount <span class="text-success">- ₹ 900</span></li>
                    <li>Delivery Charge<span class="text-success">FREE</span></li>
                    @if(isset($total))
                    <li>Total Amount <span><b>₹ {{$total}}</b></span></li>
                    @else
                    <li>Total Amount <span><b>₹ {{$total}}</b></span></li>
                    @endif
                </ul>
                <a href="#" class="d-block">Proceed to checkout</a>
            </div>
        </div>
    </div>

    @else

    <div class="card-body text-center">
        <h2>Your <i class="fa fa-shopping-cart"></i> Cart Is Empty</h2>
        <a href="" class="btnbtn-outline-primary float-end">Continue Shopping</a>
    </div>

    @endif
</div>