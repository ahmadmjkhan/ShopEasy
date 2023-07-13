<?php


use App\Models\Product;
use App\Models\Wishlist;
?>
@extends('frontend.layouts.frontend-master-layout')

@section('content')


<!-- Begin Slider With Category Menu Area -->
<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Category Menu Area -->
            <div class="col-lg-3">
                <!--Category Menu Start-->
                <div class="category-menu category-menu-2">
                    <div class="category-heading">
                        <h2 class="categories-toggle"><span>categories</span></h2>
                    </div>
                    <div id="cate-toggle" class="category-menu-list">
                        <ul>
                            <!-- <li class="right-menu"><a href="shop-left-sidebar.html">Laptops</a>
                                <ul class="cat-mega-menu">
                                    <li class="right-menu cat-mega-title">
                                        <a href="shop-left-sidebar.html">Prime Video</a>
                                        <ul>
                                            <li><a href="#">All Videos</a></li>
                                            <li><a href="#">Blouses</a></li>
                                            <li><a href="#">Evening Dresses</a></li>
                                            <li><a href="#">Summer Dresses</a></li>
                                            <li><a href="#">T-shirts</a></li>
                                            <li><a href="#">Rent or Buy</a></li>
                                            <li><a href="#">Your Watchlist</a></li>
                                            <li><a href="#">Watch Anywhere</a></li>
                                            <li><a href="#">Getting Started</a></li>
                                        </ul>
                                    </li>
                                    <li class="right-menu cat-mega-title">
                                        <a href="shop-left-sidebar.html">Computers</a>
                                        <ul>
                                            <li><a href="#">More to Explore</a></li>
                                            <li><a href="#">TV & Video</a></li>
                                            <li><a href="#">Audio & Theater</a></li>
                                            <li><a href="#">Camera, Photo</a></li>
                                            <li><a href="#">Cell Phones</a></li>
                                            <li><a href="#">Headphones</a></li>
                                            <li><a href="#">Video Games</a></li>
                                            <li><a href="#">Wireless Speakers</a></li>
                                        </ul>
                                    </li>
                                    <li class="right-menu cat-mega-title">
                                        <a href="shop-left-sidebar.html">Electronics</a>
                                        <ul>
                                            <li><a href="#">Amazon Home</a></li>
                                            <li><a href="#">Kitchen & Dining</a></li>
                                            <li><a href="#">Furniture</a></li>
                                            <li><a href="#">Bed & Bath</a></li>
                                            <li><a href="#">Appliances</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> -->



                            @foreach($all_sections as $section)
                            <li class="right-menu"><a href="shop-left-sidebar.html">{{$section->section_name}}</a>
                                @if(count($section->categories)>0)
                                <ul class="cat-mega-menu">
                                    @foreach($section->categories as $category)
                                    <li class="right-menu cat-mega-title">

                                        <a href="{{url($category->url)}}">{{$category->category_name}}</a>
                                        <ul>
                                            @foreach($category->subcategories as $subcategory)
                                            <li><a href="{{url($subcategory->url)}}">{{$subcategory->category_name}}</a></li>

                                            @endforeach
                                        </ul>


                                    </li>

                                    @endforeach
                                </ul>
                                @endif
                            </li>


                            @endforeach




                            <!-- <li><a href="#">Chamcham</a></li>
                            <li class="rx-child"><a href="#">Mobile & Tablets</a></li>
                            <li class="rx-child"><a href="#">Accessories</a></li>
                            <li class="rx-parent">
                                <a class="rx-default">More Categories</a>
                                <a class="rx-show">Less Categories</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <!--Category Menu End-->
            </div>
            <!-- Category Menu Area End Here -->
            <!-- Begin Slider Area -->
            <div class="col-lg-6 col-md-8">
                <div class="slider-area slider-area-3 pt-sm-30 pt-xs-30 pb-xs-30">
                    <div class="slider-active owl-carousel">
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide align-center-left animation-style-01 bg-1">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                <h2>Chamcham Galaxy S9 | S9+</h2>
                                <h3>Starting at <span>$1209.00</span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slide Area End Here -->
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide align-center-left animation-style-02 bg-2">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                <h2>Work Desk Surface Studio 2018</h2>
                                <h3>Starting at <span>$824.00</span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slide Area End Here -->
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide align-center-left animation-style-01 bg-3">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                <h2>Phantom 4 Pro+ Obsidian</h2>
                                <h3>Starting at <span>$1849.00</span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Slide Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->
            <div class="col-lg-3 col-md-4 text-center pt-sm-30">
                <div class="li-banner">
                    <a href="#">
                        <img src="{{asset('frontend/assets/images/banner/3_1.jpg')}}" alt="">
                    </a>
                </div>
                <div class="li-banner mt-15 mt-sm-30 mt-xs-25 mb-xs-5">
                    <a href="#">
                        <img src="{{asset('frontend/assets/images/banner/3_2.jpg')}}" alt="">
                    </a>
                </div>
            </div>
            <!-- Li Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Slider With Category Menu Area End Here -->


<!-- Begin Static Top Area -->
<div class="static-top-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="static-top-content mt-sm-30">
                    Gift Special: Gift every single day on Weekends - New Coupon code "
                    <span>LimupaSaleoff</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Static Top Area End Here -->


<!-- product-area start -->
<div class="product-area pt-55 pb-25 pt-xs-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#li-new-product"><span>New Arrival</span></a></li>
                        <li><a data-toggle="tab" href="#li-bestseller-product"><span>Bestseller</span></a></li>
                        <li><a data-toggle="tab" href="#li-featured-product"><span>Featured Products</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($newProducts as $product)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">

                                    <a href="{{route('product_details',$product->id)}}">
                                        <img src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
                                    </a>



                                    <span class="sticker">New</span>
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
                                        <h4>

                                            <a class="product_name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a>



                                        </h4>


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
                                            <li class="add-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>

                                            @if(Auth::check())
                                            <?php $countWishlist = 0; ?>
                                            <?php $countWishlist = Wishlist::countWishlist($product->id);

                                            ?>
                                            <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                            @else
                                            <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                            @endif
                                            <!-- <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li> -->
                                            <li><a class="quick-view" data-url="{{route('product_show',$product->id)}}" href="javascript:void(0)"><i class="fa fa-eye"></i></a></li>
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
            <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($bestSellers as $seller)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">


                                    <a href="{{route('product_details',$product->id)}}">
                                        <img src="{{asset('uploads/catalogue-images/products/small/'.$seller->product_image)}}" alt="Li's Product Image">
                                    </a>





                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">{{$seller->categories->category_name}}</a>
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
                                        <h4>

                                            <a class="product_name" href="{{route('product_details',$product->id)}}">{{$seller->product_name}}</a>


                                        </h4>
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
                                            <li class="add-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>
                                            @if(Auth::check())
                                            <?php $countWishlist = 0; ?>
                                            <?php $countWishlist = Wishlist::countWishlist($product->id);

                                            ?>
                                            <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                            @else
                                            <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                            @endif
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
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
            <div id="li-featured-product" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($featureProducts as $feature)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">

                                    <a href="{{route('product_details',$product->id)}}">
                                        <img src="{{asset('uploads/catalogue-images/products/small/'.$feature->product_image)}}" alt="Li's Product Image">
                                    </a>


                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">{{$feature->categories->category_name}}</a>
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
                                        <h4>

                                            <a class="product_name" href="{{route('product_details',$product->id)}}">{{$feature->product_name}}</a>


                                        </h4>
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
                                            <li class="add-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>
                                            @if(Auth::check())
                                            <?php $countWishlist = 0; ?>
                                            <?php $countWishlist = Wishlist::countWishlist($product->id);

                                            ?>
                                            <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                            @else
                                            <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                            @endif
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
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

            <div id="li-fashion-product" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($allproducts as $product)
                        @if($product->section->section_name == "Fashion")
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">


                                    <a href="{{route('product_details',$product->id)}}">
                                        <img src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
                                    </a>


                                    <span class="sticker">New</span>
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
                                        <h4>

                                            <a class="product_name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a>


                                        </h4>
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
                                            <li class="add-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>
                                            @if(Auth::check())
                                            <?php $countWishlist = 0; ?>
                                            <?php $countWishlist = Wishlist::countWishlist($product->id);

                                            ?>
                                            <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                            @else
                                            <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                            @endif
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product-area end -->


<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner li-static-banner-4 text-center pt-20">
    <div class="container">
        <div class="row">
            <!-- Begin Single Banner Area -->
            <div class="col-lg-6">
                <div class="single-banner pb-sm-30 pb-xs-30">
                    <a href="#">
                        <img src="{{asset('frontend/assets/images/banner/2_3.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
            <!-- Begin Single Banner Area -->
            <div class="col-lg-6">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('frontend/assets/images/banner/2_4.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Static Banner Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-60 pb-45 pt-sm-50 pt-xs-60">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Laptop</span>
                    </h2>
                    <ul class="li-sub-category-list">
                        <li class="active"><a href="shop-left-sidebar.html">Prime Video</a></li>
                        <li><a href="shop-left-sidebar.html">Computers</a></li>
                        <li><a href="shop-left-sidebar.html">Electronics</a></li>
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($allproducts as $product)
                        @if($product->categories->category_name == 'Laptops' || $product->categories->category_name == 'Gaming Laptops')
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('uploads/catalogue-images/products/large/'.$product->product_image)}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
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
                                        <h4><a class="product_name" href="single-product.html">{{$product->product_name}}</a></h4>

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
                                            <li class="add-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>
                                            @if(Auth::check())
                                            <?php $countWishlist = 0; ?>
                                            <?php $countWishlist = Wishlist::countWishlist($product->id);

                                            ?>
                                            <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                            @else
                                            <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                            @endif
                                            <!-- <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li> -->
                                            <li><a class="quick-view" data-url="#" href="javascript:void(0)"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        @endif
                        @endforeach


                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->
<!-- Begin Li's TV & Audio Product Area -->
<section class="product-area li-laptop-product li-tv-audio-product pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Mobiles</span>
                    </h2>
                    <ul class="li-sub-category-list">
                        <li class="active"><a href="shop-left-sidebar.html">Chamcham</a></li>
                        <li><a href="shop-left-sidebar.html">Meito</a></li>
                        <li><a href="shop-left-sidebar.html">XailStation</a></li>
                    </ul>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($allproducts as $product)
                        @if($product->section->section_name == 'Mobiles')
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">


                                    <a href="{{route('product_details',$product->id)}}">
                                        <img src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
                                    </a>

                                    <span class="sticker">New</span>
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
                                        <h4>

                                            <a class="product_name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a>


                                        </h4>
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
                                            <li class="add-cart active"><a href="{{route('product_details',$product->id)}}">Add to cart</a></li>
                                            @if(Auth::check())
                                            <?php $countWishlist = 0; ?>
                                            <?php $countWishlist = Wishlist::countWishlist($product->id);

                                            ?>
                                            <li><a class="links-details updateWishlist" data-productid="{{$product->id}}">@if($countWishlist>0)<i class="fa fa-heart"></i>@else<i class="fa fa-heart-o"></i>@endif</a></li>
                                            @else
                                            <li><a class="links-details"><i class="fa fa-heart-o"></i></a></li>

                                            @endif
                                            <!-- <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li> -->
                                            <li><a class="quick-view" data-url="{{route('product_show',$product->id)}}" href="javascript:void(0)"><i class="fa fa-eye"></i></a></li>

                                        </ul>

                                    </div>


                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>

                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's TV & Audio Product Area End Here -->
<!-- Begin Li's Static Home Area -->
<div class="li-static-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Begin Li's Static Home Image Area -->
                <div class="li-static-home-image"></div>
                <!-- Li's Static Home Image Area End Here -->
                <!-- Begin Li's Static Home Content Area -->
                <div class="li-static-home-content">
                    <p>Sale Offer<span>-20% Off</span>This Week</p>
                    <h2>Featured Product</h2>
                    <h2>Sanai Accessories 2018</h2>
                    <p class="schedule">
                        Starting at
                        <span> $1209.00</span>
                    </p>
                    <div class="default-btn">
                        <a href="shop-left-sidebar.html" class="links">Shopping Now</a>
                    </div>
                </div>
                <!-- Li's Static Home Content Area End Here -->
            </div>
        </div>
    </div>
</div>
<!-- Li's Static Home Area End Here -->
<!-- Begin Group Featured Product Area -->
<div class="group-featured-product pt-60 pb-40 pb-xs-25">
    <div class="container">
        <div class="row">
            <!-- Begin Featured Product Area -->

            <div class="col-lg-4">
                <div class="featured-product">
                    <div class="li-section-title">
                        <h2>
                            <span>Mobiles</span>
                        </h2>
                    </div>
                    <div class="featured-product-active-2 owl-carousel">
                        <div class="featured-product-bundle">
                            @foreach($allproducts as $product)
                            @if($product->section->section_name=="Mobiles")
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="{{url($product->categories->url)}}">{{$product->categories->category_name}}</a>
                                            </h5>
                                        </div>
                                        <div class="rating-box">
                                            <ul class="rating">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <h4><a class="featured-product-name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a></h4>
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
                                </div>
                            </div>
                            @endif

                           
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="featured-product">
                    <div class="li-section-title">
                        <h2>
                            <span>Laptops</span>
                        </h2>
                    </div>
                    <div class="featured-product-active-2 owl-carousel">
                        <div class="featured-product-bundle">
                            @foreach($allproducts as $product)
                            @if($product->categories->category_name=="Laptops")
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="{{url($product->categories->url)}}">{{$product->categories->category_name}}</a>
                                            </h5>
                                        </div>
                                        <div class="rating-box">
                                            <ul class="rating">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <h4><a class="featured-product-name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a></h4>
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
                                </div>
                            </div>
                            @endif

                           
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="featured-product">
                    <div class="li-section-title">
                        <h2>
                            <span>Appliances</span>
                        </h2>
                    </div>
                    <div class="featured-product-active-2 owl-carousel">
                        <div class="featured-product-bundle">
                            @foreach($allproducts as $product)
                            @if($product->section->section_name=="Appliances")
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="{{asset('uploads/catalogue-images/products/small/'.$product->product_image)}}">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="{{url($product->categories->url)}}">{{$product->categories->category_name}}</a>
                                            </h5>
                                        </div>
                                        <div class="rating-box">
                                            <ul class="rating">
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <h4><a class="featured-product-name" href="{{route('product_details',$product->id)}}">{{$product->product_name}}</a></h4>
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
                                </div>
                            </div>
                            @endif

                           
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        
        </div>
    </div>
</div>
<!-- Group Featured Product Area End Here -->




@endsection

@section('script')
<script>
    $('#forgotpassword').on('click', function() {
        $('#loginModal').modal('hide');
        $('#ForgotPasswordModal').modal('show');

    });

    $('#backtologin').on('click', function() {
        $('#loginModal').modal('show');
        $('#ForgotPasswordModal').modal('hide');
    });
</script>
@endsection