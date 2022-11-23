<?php

use App\Models\Products; ?>
@extends('layouts.frontend')


@section('content')

<!-- Begin Slider With Banner Area -->
@include('layouts.inc.frontend-slider')
<!-- Slider With Banner Area End Here -->

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
                        <li><a data-toggle="tab" href="#li-fashion-product"><span>Fashion</span></a></li>
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
                                    <a href="{{route('product_deatail',$product->id)}}">
                                        <img src="{{asset('uploads/images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
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
                                        <h4><a class="product_name" href="{{route('product_deatail',$product->id)}}">{{$product->product_name}}</a></h4>


                                        <?php
                                        $getDiscountPrice = Products::getDiscountPrice($product->id);

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
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <!-- <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li> -->
                                            <li><a class="quick-view" data-url="{{route('product_show',$product->id)}}" href="javascript:void(0)" ><i class="fa fa-eye"></i></a></li>
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
                                    <a href="{{route('product_deatail',$product->id)}}">
                                        <img src="{{asset('uploads/images/products/small/'.$seller->product_image)}}" alt="Li's Product Image">
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
                                        <h4><a class="product_name" href="{{route('product_deatail',$product->id)}}">{{$seller->product_name}}</a></h4>
                                        <?php
                                        $getDiscountPrice = Products::getDiscountPrice($product->id);

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
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
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
                                    <a href="{{route('product_deatail',$product->id)}}">
                                        <img src="{{asset('uploads/images/products/small/'.$feature->product_image)}}" alt="Li's Product Image">
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
                                        <h4><a class="product_name" href="{{route('product_deatail',$product->id)}}">{{$feature->product_name}}</a></h4>
                                        <?php
                                        $getDiscountPrice = Products::getDiscountPrice($product->id);

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
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
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
                                    <a href="{{route('product_deatail',$product->id)}}">
                                        <img src="{{asset('uploads/images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
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
                                        <h4><a class="product_name" href="{{route('product_deatail',$product->id)}}">{{$product->product_name}}</a></h4>
                                        <?php
                                        $getDiscountPrice = Products::getDiscountPrice($product->id);

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
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
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
                        <img src="{{asset('frontend/images/banner/2_3.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
            <!-- Begin Single Banner Area -->
            <div class="col-lg-6">
                <div class="single-banner">
                    <a href="#">
                        <img src="{{asset('frontend/images/banner/2_4.jpg')}}" alt="Li's Static Banner">
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
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/product/large-size/1.jpg')}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Graphic Corner</a>
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
                                        <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                        <div class="price-box">
                                            <span class="new-price">$46.80</span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <!-- <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li> -->
                                            <li><a class="quick-view" data-url="{{route('product_show',$product->id)}}" href="javascript:void(0)" ><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/product/large-size/2.jpg')}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="price-box">
                                            <span class="new-price new-price-2">$71.80</span>
                                            <span class="old-price">$77.22</span>
                                            <span class="discount-percentage">-7%</span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/product/large-size/3.jpg')}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Graphic Corner</a>
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
                                        <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                        <div class="price-box">
                                            <span class="new-price">$46.80</span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/product/large-size/4.jpg')}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="price-box">
                                            <span class="new-price new-price-2">$71.80</span>
                                            <span class="old-price">$77.22</span>
                                            <span class="discount-percentage">-7%</span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/product/large-size/5.jpg')}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Graphic Corner</a>
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
                                        <h4><a class="product_name" href="single-product.html">Accusantium dolorem1</a></h4>
                                        <div class="price-box">
                                            <span class="new-price">$46.80</span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/product/large-size/6.jpg')}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="product_name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="price-box">
                                            <span class="new-price new-price-2">$71.80</span>
                                            <span class="old-price">$77.22</span>
                                            <span class="discount-percentage">-7%</span>
                                        </div>
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-wrap end -->
                        </div>
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
                                    <a href="{{route('product_deatail',$product->id)}}">
                                        <img src="{{asset('uploads/images/products/small/'.$product->product_image)}}" alt="Li's Product Image">
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
                                        <h4><a class="product_name" href="{{route('product_deatail',$product->id)}}">{{$product->product_name}}</a></h4>
                                        <?php
                                        $getDiscountPrice = Products::getDiscountPrice($product->id);

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
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a class="links-details" href="single-product.html"><i class="fa fa-heart-o"></i></a></li>
                                            <!-- <li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="fa fa-eye"></i></a></li> -->
                                            <li><a class="quick-view" data-url="{{route('product_show',$product->id)}}" href="javascript:void(0)" ><i class="fa fa-eye"></i></a></li>
                                            
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
                            <span>Chamcham</span>
                        </h2>
                    </div>
                    <div class="featured-product-active-2 owl-carousel">
                        <div class="featured-product-bundle">
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/1.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/2.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/3.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Product Area End Here -->
            <!-- Begin Featured Product Area -->
            <div class="col-lg-4">
                <div class="featured-product pt-sm-10 pt-xs-25">
                    <div class="li-section-title">
                        <h2>
                            <span>Meito</span>
                        </h2>
                    </div>
                    <div class="featured-product-active-2 owl-carousel">
                        <div class="featured-product-bundle">
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/4.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/5.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/6.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Product Area End Here -->
            <!-- Begin Featured Product Area -->
            <div class="col-lg-4">
                <div class="featured-product pt-sm-10 pt-xs-25">
                    <div class="li-section-title">
                        <h2>
                            <span>Sanai</span>
                        </h2>
                    </div>
                    <div class="featured-product-active-2 owl-carousel">
                        <div class="featured-product-bundle">
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/6.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/4.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="group-featured-pro-wrapper">
                                    <div class="product-img">
                                        <a href="product-details.html">
                                            <img alt="" src="images/featured-product/2.jpg">
                                        </a>
                                    </div>
                                    <div class="featured-pro-content">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">Studio Design</a>
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
                                        <h4><a class="featured-product-name" href="single-product.html">Mug Today is a good day</a></h4>
                                        <div class="featured-price-box">
                                            <span class="new-price">$71.80</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Product Area End Here -->
        </div>
    </div>
</div>
<!-- Group Featured Product Area End Here -->


<!-- Begin Quick View | Modal Area -->
<!-- <div class="modal fade modal-wrapper" id="exampleModalCenter"> -->
<div class="modal fade modal-wrapper" id="quickviewmodal">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <!-- Product Details Left -->
                        <div class="product-details-left">
                            <div class="product-details-images slider-navigation-1">
                                <div class="lg-image">
                                   
                                </div>
                               
                            </div>
                            <div class="product-details-thumbs slider-thumbs-1">
                                <div class="sm-image">

                                </div>
                               
                            </div>
                        </div>
                        <!--// Product Details Left -->
                    </div>

                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="product-details-view-content pt-60">
                            <div class="product-info">
                                <h2><span id="product_name"></span></h2>
                                <span id="category_name"></span>
                                <div class="rating-box pt-20">
                                    <ul class="rating rating-with-review-item">
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="review-item"><a href="#">Read Review</a></li>
                                        <li class="review-item"><a href="#">Write Review</a></li>
                                    </ul>
                                </div>
                                <div class="price-box pt-20">
                                   
                                </div>
                                <div class="product-desc">
                                    <p>
                                        <span id="desc">
                                        </span>
                                    </p>
                                </div>
                                <!-- <div class="product-variants">
                                    <div class="produt-variants-size">
                                        <label>Dimension</label>
                                        <select class="nice-select">
                                            <option value="1" title="S" selected="selected">40x60cm</option>
                                            <option value="2" title="M">60x90cm</option>
                                            <option value="3" title="L">80x120cm</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="single-add-to-cart">
                                    <form action="#" class="cart-quantity">
                                        <div class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </div>
                                        <button class="add-to-cart" type="submit">Add to cart</button>
                                    </form>
                                </div>
                                <div class="product-additional-info pt-25">
                                    <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View | Modal Area End Here -->





@endsection


@section('script')

<script>

    $(document).ready(function(){

        $('body').on('click','.quick-view',function(){

            var url = $(this).data('url');
            $.get(url,function(data){

                
                $('#quickviewmodal').modal('show');
                $("#product_name").text(data.product_name);
                $("#category_name").text(data.categories.category_name);
                $("#desc").text(data.long_description);
                $(".lg-image").html('<img src="uploads/images/products/medium/'+data.product_image+' " alt="product image">');
                
            });

            // $.each(data,function(key,item){
            //     $('#quickviewmodal').modal('show'); 
            //     $('.modal-inner-area').append(''); 
            // });
           
        });
    });
</script>
@endsection
