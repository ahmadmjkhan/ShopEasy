<?php

use App\Models\Product;

$getCartItems = getCartItems();


?>

    <ul class="minicart-product-list">
        @php $total = 0; @endphp
        @foreach($getCartItems as $cart)
        <?php
        $getDiscountAttributePrice = Product::getAttributeDiscountPrice($cart->product_id, $cart->size);
        ?>
        <li>
            <a href="single-product.html" class="minicart-product-image">
                <img src="{{asset('uploads/catalogue-images/products/small/'.$cart->product->product_image)}}" alt="cart products">
            </a>
            <div class="minicart-product-details">
                <h6><a href="single-product.html">{{$cart->product->product_name}}</a></h6>
                <span>₹{{$getDiscountAttributePrice['final_price']}}</span>
            </div>
            <button class="close">
                <i class="fa fa-close"></i>
            </button>
        </li>
        @php $total = $total + ($getDiscountAttributePrice['final_price'] * $cart->quantity); @endphp
        @endforeach

    </ul>
    <p class="minicart-total">SUBTOTAL: <span>₹ {{$total}}</span></p>
    <div class="minicart-button">
        <a href="{{route('user.shop_cart_page')}}" class="li-button li-button-dark li-button-fullwidth li-button-sm">
            <span>View Full Cart</span>
        </a>
        <a href="checkout.html" class="li-button li-button-fullwidth li-button-sm">
            <span>Checkout</span>
        </a>
    </div>
