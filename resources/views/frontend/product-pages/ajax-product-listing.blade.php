<?php

use App\Models\Product;
use App\Models\Wishlist;
?>
<!-- shop-products-wrapper start -->
<div class="shop-products-wrapper ">
    <div class="tab-content">
        <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
            <div class="product-area shop-product-area">
                <div class="row page-reload">
                    @foreach($categoryProducts as $product)

                    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{route('product_details',$product->id)}}">
                                    <img src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
                                </a>
                                <?php $isProductNew = Product::isProductNew($product['id']);  ?>
                                @if($isProductNew=="Yes")
                                <span class="sticker">New</span>
                                @endif
                            </div>
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                            <a href="product-details.html">{{$product->categories->category_name}}</a>
                                        </h5>
                                        <div class="rating-box">
                                            <ul class="rating">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h4><a class="product_name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a></h4>
                                    <?php
                                    $getDiscountPrice = Product::getDiscountPrice($product->id);

                                    ?>

                                    @if($getDiscountPrice>0)
                                    <div class="price-box">
                                        <span class="new-price new-price-2">Rs: {{$getDiscountPrice}}</span>
                                        <span class="old-price">{{$product->product_price}}</span>
                                        <span class="discount-percentage">-7%</span>
                                    </div>
                                    @else
                                    <div class="price-box">

                                        <span class="old-price">Rs: {{$product->product_price}}</span>

                                    </div>
                                    @endif
                                </div>
                                <div class="add-actions">
                                    <ul class="add-actions-link">

                                        <li class="add-cart add-to-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>

                                        <li><a href="#" title="quick view" class="quick-view-btn btnQuickView" data-toggle="modal" data-target="#quickViewModal" data-product-name="{{$product->product_name}}" data-product-category="{{$product->categories->category_name}}" data-product-description="{{$product->short_description}}" data-product-img="{{asset('uploads/catalogue-images/products/large/'.$product->product_image)}}" data-product-price="{{$product->product_price}}"><i class="fa fa-eye"></i></a></li>
                                        @if(Auth::check())
                                        <?php $countWishlist = 0; ?>
                                        <?php $countWishlist = Wishlist::countWishlist($product->id);

                                        ?>
                                        <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                        @else
                                        <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-wrap end -->
                    </div>

                    @endforeach
                </div>
            </div>
        </div>


        <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
            <div class="row">
                <div class="col">
                    <div class="row product-layout-list">
                        @foreach($categoryProducts as $product)
                        <div class="col-lg-3 col-md-5 ">
                            <div class="product-image">
                                <a href="{{route('product_details',$product->id)}}">
                                    <img src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
                                </a>
                                <?php $isProductNew = Product::isProductNew($product['id']);  ?>
                                @if($isProductNew=="Yes")
                                <span class="sticker">New</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-7">
                            <div class="product_desc">
                                <div class="product_desc_info">
                                    <div class="product-review">
                                        <h5 class="manufacturer">
                                            <a href="product-details.html">{{$product->categories->category_name}}</a>
                                        </h5>
                                        <div class="rating-box">
                                            <ul class="rating">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h4><a class="product_name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a></h4>
                                    <?php
                                    $getDiscountPrice = Product::getDiscountPrice($product->id);

                                    ?>

                                    @if($getDiscountPrice>0)
                                    <div class="price-box">
                                        <span class="new-price new-price-2">Rs: {{$getDiscountPrice}}</span>
                                        <span class="old-price">{{$product->product_price}}</span>
                                        <span class="discount-percentage">-7%</span>
                                    </div>
                                    @else
                                    <div class="price-box">

                                        <span class="old-price">Rs: {{$product->product_price}}</span>

                                    </div>
                                    @endif
                                    <p>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite Sound via Ring Radiator Technology. Stream And Control R3 Speakers Wirelessly With Your Smartphone. Sophisticated, Modern Desig</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shop-add-action mb-xs-30">
                                <ul class="add-actions-link">
                                    <li class="add-cart add-to-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>

                                    @if(Auth::check())
                                    <?php $countWishlist = 0; ?>
                                    <?php $countWishlist = Wishlist::countWishlist($product->id);

                                    ?>
                                    <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                    @else
                                    <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                    @endif

                                    <li><a href="#" title="quick view" class="quick-view-btn btnQuickView" data-toggle="modal" data-target="#exampleModalCenter" data-product-name="{{$product->product_name}}" data-product-description="{{$product->short_description}}" data-product-img="{{asset('uploads/catalogue-images/products/large/'.$product->product_image)}}" data-product-price="{{$product->product_price}}"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>






<script src="{{asset('frontend/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>




<!-- shop-products-wrapper end -->