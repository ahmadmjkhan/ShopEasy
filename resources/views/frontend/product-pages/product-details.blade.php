<?php

use App\Models\Product;
use App\Models\ProductFilter;


$productFilters = ProductFilter::productFilters();
?>
@extends('frontend.layouts.frontend-master-layout')


@section('content')

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Single Product Sale</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">

        <div class="row single-product-area ">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">

                        @foreach($productdetails->multiple_images as $multiple)
                        <div class="lg-image"><img src="{{asset('uploads/catalogue-images/products/multiple-images/large/'.$multiple->images)}}" alt="product image thumb"></div>
                        @endforeach
                        <!-- <img src="{{asset('uploads/images/products/small/'.$productdetails->product_image)}}" alt="product image"> -->


                    </div>
                    <div class="product-details-thumbs slider-thumbs-1 mt-3">


                        @foreach($productdetails->multiple_images as $multiple)
                        <div class="sm-image"><img src="{{asset('uploads/catalogue-images/products/multiple-images/small/'.$multiple->images)}}" alt="product image thumb"></div>
                        @endforeach

                        <!-- <div class="sm-image"><img src="images/product/small-size/2.jpg" alt="product image thumb"></div>
                        <div class="sm-image"><img src="images/product/small-size/3.jpg" alt="product image thumb"></div>
                        <div class="sm-image"><img src="images/product/small-size/4.jpg" alt="product image thumb"></div>
                        <div class="sm-image"><img src="images/product/small-size/5.jpg" alt="product image thumb"></div>
                        <div class="sm-image"><img src="images/product/small-size/6.jpg" alt="product image thumb"></div> -->
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">

                @if(Session::has('success_message'))

                <div class="alert-success">
                    {{Session::get('success_message')}}
                </div>
                @endif

                @if(Session::has('error_message'))

                <div class="alert alert-danger">
                    {{Session::get('error_message')}}
                </div>
                @endif
                <div class="product-details-view-content sp-sale-content pt-60 product-data">
                    <input type="hidden" value="{{$productdetails->id}}" class="prod_id">
                    <div class="product-info">
                        <h2>{{$productdetails->product_name}}</h2>
                        <span class="product-details-ref">{{$productdetails->categories->category_name}}</span>
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
                        <?php
                        $getDiscountPrice = Product::getDiscountPrice($productdetails->id);

                        ?>

                        <span class="getAttributedPrice">


                            @if($getDiscountPrice>0)
                            <div class="price-box">
                                <span class="new-price new-price-2">Rs: {{$getDiscountPrice}}</span>
                                <span class="old-price"><s>{{$productdetails->product_price}}</s></span>
                                <span class="discount-percentage">-7%</span>
                            </div>
                            @else
                            <div class="price-box">

                                <span class="old-price">Rs: {{$productdetails->product_price}}</span>

                            </div>
                            @endif

                        </span>
                        <div class="countersection">
                            <div class="li-countdown product-sale-countdown"></div>
                        </div>
                        <div class="product-desc mt-3">
                            <h6>Short Description</h6>
                            <p>
                                <span>{{$productdetails->short_description}}
                                </span>
                            </p>
                        </div>


                        <div class="product-desc mt-3">
                            <h6>SKU Information</h6>

                            <label for="">Product Code:</label><span>{{$productdetails->product_code}}</span><br>
                            <label for="">Product Color:</label><span>{{$productdetails->product_color}}</span><br>
                            <label for="">Availability:</label>
                            @if($totalstock>0)
                            <span class="text text-success">In Stock</span><br>
                            @else
                            <span class="text text-danger">Out of Stock</span><br>
                            @endif

                            @if($totalstock>0)
                            <label for="">Left:</label><span> {{$totalstock }} Left</span>
                            @endif
                        </div>

                        <div class="product-desc mt-3">
                            <label>Sold By:</label>

                            @if(isset($productdetails->seller_id))
                            <span>{{$productdetails->sellers->name}}
                            </span>
                            @endif

                        </div>





                        <form action="{{route('user.cart_add')}}" method="post" class="form_operation">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$productdetails->id}}">
                            <div class="product-variants">
                                <div class="produt-variants-size">
                                    <label>Sizes</label>
                                    <select class="nice-select" name="size" id="getPrice" product-id="{{$productdetails->id}}">
                                        <option value="">Select Sizes</option>
                                        @foreach($productdetails->attributes as $attribute)
                                        <option value="{{$attribute->size}}">{{$attribute->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="single-add-to-cart">

                                <div class="quantity">
                                    <label>Quantity</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box  qty_input" value="1" name="quantity" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <button class="add-to-cart" type="submit">Add to cart</button>

                            </div>
                        </form>


                        <br><br><br>
                        <b>Enter Pincode</b>
                        <input type="text" id="pincode" placeholder="Check Pincode">
                        <button class="btn btn-sm btn-danger mt-2" id="checkpincode">Check</button>



                        <div class="success_message text-success mt-2" style="display:none;"></div>
                        <div class="error_message text-danger mt-2" style="display:none;"></div>



                        <div class="product-additional-info pt-25">
                            <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>

                        </div>
                        <div class="block-reassurance">
                            <ul>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <p>Security policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <p>Delivery policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <p> Return policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                        <li><a data-toggle="tab" href="#product-details"><span>Product Details</span></a></li>
                        <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    <span>The best is yet to come! Give your walls a voice with a framed poster. This aesthethic, optimistic poster will look great in your desk or in an open-space office. Painted wooden frame with passe-partout for more depth.</span>
                </div>
            </div>
            <div id="product-details" class="tab-pane" role="tabpanel">
                <div class="product-details-manufacturer">
                    <a href="#">
                        <img src="images/product-details/1.jpg" alt="Product Manufacturer Image">
                    </a>
                    @foreach($productFilters as $filter)
                    @if(isset($productdetails->category_id))
                    <?php
                    $filterAvailable = ProductFilter::filterAvailable($filter->id, $productdetails->category_id);
                    ?>

                    @if($filterAvailable == "Yes")

                    <p><span>{{$filter->filter_name}}</span>

                        @foreach($filter->filter_values as $value)

                        @if(!empty($productdetails->{$filter['filter_column']}) && $value->filter_value==$productdetails->{$filter['filter_column']})
                        {{ucwords($value->filter_value)}}

                        @endif
                        @endforeach

                    </p>

                    @endif
                    @endif
                    @endforeach
                </div>
            </div>
            <div id="reviews" class="tab-pane" role="tabpanel">
                <div class="product-reviews">
                    <div class="product-details-comment-block">
                        <div class="comment-review">
                            <span>Grade</span>
                            <ul class="rating">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                            </ul>
                        </div>
                        <div class="comment-author-infos pt-25">
                            <span>HTML 5</span>
                            <em>01-12-18</em>
                        </div>
                        <div class="comment-details">
                            <h4 class="title-block">Demo</h4>
                            <p>Plaza</p>
                        </div>
                        <div class="review-btn">
                            <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a>
                        </div>
                        <!-- Begin Quick View | Modal Area -->
                        <div class="modal fade modal-wrapper" id="mymodal">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h3 class="review-page-title">Write Your Review</h3>
                                        <div class="modal-inner-area row">
                                            <div class="col-lg-6">
                                                <div class="li-review-product">
                                                    <img src="images/product/large-size/3.jpg" alt="Li's Product">
                                                    <div class="li-review-product-desc">
                                                        <p class="li-product-name">Today is a good day Framed poster</p>
                                                        <p>
                                                            <span>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite Sound via Ring Radiator Technology. Stream And Control R3 Speakers Wirelessly With Your Smartphone. Sophisticated, Modern Design </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="li-review-content">
                                                    <!-- Begin Feedback Area -->
                                                    <div class="feedback-area">
                                                        <div class="feedback">
                                                            <h3 class="feedback-title">Our Feedback</h3>
                                                            <form action="#">
                                                                <p class="your-opinion">
                                                                    <label>Your Rating</label>
                                                                    <span>
                                                                        <select class="star-rating">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <p class="feedback-form">
                                                                    <label for="feedback">Your Review</label>
                                                                    <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                                </p>
                                                                <div class="feedback-input">
                                                                    <p class="feedback-form-author">
                                                                        <label for="author">Name<span class="required">*</span>
                                                                        </label>
                                                                        <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                                    </p>
                                                                    <p class="feedback-form-author feedback-form-email">
                                                                        <label for="email">Email<span class="required">*</span>
                                                                        </label>
                                                                        <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                                        <span class="required"><sub>*</sub> Required fields</span>
                                                                    </p>
                                                                    <div class="feedback-btn pb-15">
                                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                                                                        <a href="#">Submit</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Feedback Area End Here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick View | Modal Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->
<!-- Begin Li's Laptop Product Area -->
<section class="product-area li-laptop-product pt-30 pb-50">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Related Products:</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach($relatedproducts as $related)
                        <div class="col-lg-12">
                            <!-- single-product-wrap start -->
                            <div class="single-product-wrap">
                                <div class="product-image">
                                    <a href="single-product.html">
                                        <img src="{{asset('uploads/images/products/small/'.$related->product_image)}}" alt="Li's Product Image">
                                    </a>
                                    <span class="sticker">New</span>
                                </div>
                                <div class="product_desc">
                                    <div class="product_desc_info">
                                        <div class="product-review">
                                            <h5 class="manufacturer">
                                                <a href="product-details.html">{{$related->categories->category_name}}</a>
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
                                        <h4><a class="product_name" href="single-product.html">{{$related->product_name}}</a></h4>
                                        <?php
                                        $getDiscountPrice = Product::getDiscountPrice($related->id);

                                        ?>

                                        @if($getDiscountPrice>0)
                                        <div class="price-box">
                                            <span class="new-price new-price-2">Rs: {{$getDiscountPrice}}</span>
                                            <span class="old-price"><s>{{$related->product_price}}</s></span>
                                            <span class="discount-percentage">-7%</span>
                                        </div>
                                        @else
                                        <div class="price-box">

                                            <span class="old-price">Rs: {{$related->product_price}}</span>

                                        </div>
                                        @endif
                                    </div>
                                    <div class="add-actions">
                                        <ul class="add-actions-link">
                                            <li class="add-cart active"><a href="#">Add to cart</a></li>
                                            <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                                            <li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
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
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>
<!-- Li's Laptop Product Area End Here -->

@endsection