<?php

use App\Models\Section;

$sections = Section::sections();
$totalCartItems = totalCartItems();
$totalWishlistItems = totalWishlistItems();
// echo "<pre>";print_r($totalCartItems);die;
?>


<header class="li-header-4">
    <!-- Begin Header Top Area -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                            <!-- Begin Setting Area -->

                            <li>
                                <a href="{{route('seller.register')}}" class="text-white">Become A Seller</a>
                            </li>
                            <!-- Setting Area End Here -->
                            <!-- Begin Currency Area -->


                            @auth('web')


                            <li>
                                <div class="ht-setting-trigger"><span style="font-size:14px;"><img src="{{asset('uploads/user_avatar/'.Auth::user()->user_avatar)}}" alt="" style="height: 40px;" class="w-25 rounded-circle mr-2"> {{Auth::user()->name}}</span></div>
                                <div class="setting ht-setting">
                                    <ul class="ht-setting-list">
                                        <li><a href="{{route('user.my-account')}}">My Account</a></li>
                                        <li><a href="{{route('user.your-orders')}}">My Orders</a></li>
                                        <li>
                                            <a href="{{route('user.logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Log Out</a>
                                            <form action="{{route('user.logout')}}" id="logout-form" method="post">@csrf</form>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            @else

                            <li><a href="#" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#loginModal">Login</a></li>

                            <li><a href="" data-toggle="modal" data-target="#registerModal" class="btn btn-sm btn-danger text-white">New Customer?</a></li>

                            @endauth



                            <!-- Begin Language Area -->
                            <!-- <li>
                                <span class="language-selector-wrapper">Language :</span>
                                <div class="ht-language-trigger"><span>English</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li class="active"><a href="#"><img src="images/menu/flag-icon/1.jpg" alt="">English</a></li>
                                        <li><a href="#"><img src="images/menu/flag-icon/2.jpg" alt="">Français</a></li>
                                    </ul>
                                </div>
                            </li> -->
                            <!-- Language Area End Here -->
                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Top Area End Here -->
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        @if(Auth::guard('web')->user())
                        <a href="{{route('user.home')}}">
                            <img src="{{asset('uploads/shopeasy-logo6.png')}}" style="margin-left:-25px;width:100%;margin-top:-23px;height:100px;" alt="">
                        </a>
                        @else
                        <a href="{{route('index')}}">
                            <img src="{{asset('uploads/shopeasy-logo6.png')}}" style="margin-left:-25px;width:100%;margin-top:-23px;height:100px;" alt="">
                        </a>
                        @endif

                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                    <!-- Begin Header Middle Searchbox Area -->
                    @if(Auth::check())
                    <form action="{{url('user/search-products')}}" class="hm-searchbox" method="get">
                        <select class="nice-select select-search-category" name="section_id">
                            <option selected="selected" value="">All</option>
                            @foreach($sections as $section)
                            <option @if(isset($_REQUEST['section_id'])&& !empty($_REQUEST['section_id']))selected="" @endif value="{{$section->id}}" >{{$section->section_name}}</option>
                            @endforeach

                        </select>
                        <input type="text" placeholder="Enter your search key ..."  name="search" @if(isset($_REQUEST['search']) && !empty($_REQUEST['search'])) value="{{$_REQUEST['search']}}" @endif>
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>

                    @else
                    <form action="{{url('/search-products')}}" class="hm-searchbox" method="get">
                        <select class="nice-select select-search-category" name="section_id">
                            <option selected="selected" value="">All</option>
                            @foreach($sections as $section)
                            <option @if(isset($_REQUEST['section_id'])&& !empty($_REQUEST['section_id']))selected="" @endif value="{{$section->id}}" >{{$section->section_name}}</option>
                            @endforeach

                        </select>
                        <input type="text" placeholder="Enter your search key ..."  name="search" @if(isset($_REQUEST['search']) && !empty($_REQUEST['search'])) value="{{$_REQUEST['search']}}" @endif>
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>

                    @endif
                    
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            <li class="hm-wishlist">
                                <a href="{{route('user.wishlist')}}">
                                    <span class="cart-item-count wishlist-item-count totalWishlistItems">{{totalWishlistItems()}}</span>
                                    <i class="fa fa-heart-o"></i>
                                </a>
                            </li>
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    <span class="item-text">£80.00
                                        <span class="cart-item-count cart-count totalcartitems">{{$totalCartItems}}</span>
                                    </span>
                                </div>
                                <span></span>
                                <div class="minicart" id="append-mini-cart-items">

                                    @include('frontend.cart-pages.append-mini-cart-items')


                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky stick d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">



                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>

                            <ul>

                                
                                
                                <!-- <li class="dropdown-holder"><a href="index.html">Home</a>
                                    <ul class="hb-dropdown">
                                        <li><a href="index.html">Home One</a></li>
                                        <li><a href="index-2.html">Home Two</a></li>
                                        <li><a href="index-3.html">Home Three</a></li>
                                        <li class="active"><a href="index-4.html">Home Four</a></li>
                                    </ul>
                                </li> -->

                                <!-- <li class="megamenu-holder"><a href="shop-left-sidebar.html">Shop</a>
                                    <ul class="megamenu hb-megamenu">
                                        <li><a href="shop-left-sidebar.html">Shop Page Layout</a>
                                            <ul>
                                                <li><a href="shop-3-column.html">Shop 3 Column</a></li>
                                                <li><a href="shop-4-column.html">Shop 4 Column</a></li>
                                                <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                                <li><a href="shop-list.html">Shop List</a></li>
                                                <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                                <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="single-product-gallery-left.html">Single Product Style</a>
                                            <ul>
                                                <li><a href="single-product-carousel.html">Single Product Carousel</a></li>
                                                <li><a href="single-product-gallery-left.html">Single Product Gallery Left</a></li>
                                                <li><a href="single-product-gallery-right.html">Single Product Gallery Right</a></li>
                                                <li><a href="single-product-tab-style-top.html">Single Product Tab Style Top</a></li>
                                                <li><a href="single-product-tab-style-left.html">Single Product Tab Style Left</a></li>
                                                <li><a href="single-product-tab-style-right.html">Single Product Tab Style Right</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="single-product.html">Single Products</a>
                                            <ul>
                                                <li><a href="single-product.html">Single Product</a></li>
                                                <li><a href="single-product-sale.html">Single Product Sale</a></li>
                                                <li><a href="single-product-group.html">Single Product Group</a></li>
                                                <li><a href="single-product-normal.html">Single Product Normal</a></li>
                                                <li><a href="single-product-affiliate.html">Single Product Affiliate</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li> -->

                                @foreach($sections as $section)
                                 @if(count($section->categories))
                                <li class="dropdown-holder"><a href="blog-left-sidebar.html">{{$section->section_name}}</a>
                                    <ul class="hb-dropdown">
                                    @foreach($section->categories as $category)
                                        <li class="sub-dropdown-holder"><a href="{{url($category->url)}}">{{$category->category_name}}</a>
                                            <ul class="hb-dropdown hb-sub-dropdown">
                                            @foreach($category->subcategories as $subcategory)
                                                <li><a href="{{url($subcategory->url)}}">{{$subcategory->category_name}}</a></li>
                                           
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                        <!-- <li class="sub-dropdown-holder"><a href="blog-list-left-sidebar.html">Blog List View</a>
                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                <li><a href="blog-list.html">Blog List</a></li>
                                                <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a></li>
                                                <li><a href="blog-list-right-sidebar.html">List Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-details-left-sidebar.html">Blog Details</a>
                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                <li><a href="blog-details-left-sidebar.html">Left Sidebar</a></li>
                                                <li><a href="blog-details-right-sidebar.html">Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="sub-dropdown-holder"><a href="blog-gallery-format.html">Blog Format</a>
                                            <ul class="hb-dropdown hb-sub-dropdown">
                                                <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                <li><a href="blog-gallery-format.html">Blog Gallery Format</a></li>
                                            </ul>
                                        </li> -->
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                                <!-- <li class="megamenu-static-holder"><a href="index.html">Fashion</a>

                                    <ul class="megamenu hb-megamenu">




                                        <li><a href="blog-left-sidebar.html">Men's Fashion</a>

                                            <ul>

                                                <li><a href="blog-2-column.html">Men's Topwear</a></li>
                                                <li><a href="blog-2-column.html">Men's Bottomwear</a></li>
                                                <li><a href="blog-2-column.html">Men's Shirts</a></li>
                                                <li><a href="blog-2-column.html">Men's Top</a></li>

                                            </ul>

                                        </li>



                                        <li><a href="blog-details-left-sidebar.html">Women's Fashion</a>
                                            <ul>
                                                <li><a href="blog-details-left-sidebar.html">Left Sidebar</a></li>
                                                <li><a href="blog-details-right-sidebar.html">Right Sidebar</a></li>
                                                <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                <li><a href="blog-gallery-format.html">Blog Gallery Format</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="index.html">Kids Wear</a>
                                            <ul>
                                                <li><a href="login-register.html">My Account</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="compare.html">Compare</a></li>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="index.html">Other Pages 2</a>
                                            <ul>
                                                <li><a href="contact.html">Contact</a></li>
                                                <li><a href="about-us.html">About Us</a></li>
                                                <li><a href="faq.html">FAQ</a></li>
                                                <li><a href="404.html">404 Error</a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li> -->
                                
                                

                                <!-- <li><a href="about-us.html">Mobiles</a></li>
                                <li><a href="contact.html">Contact</a></li> -->
                               
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area mobile-menu-area-4 d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>