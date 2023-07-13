@extends('frontend.layouts.frontend-master-layout')

@section('content')

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Wishlist</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Wishlist Area Strat-->
<div class="wishlist-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="appendWishlistItems">
                    @include('frontend.wishlist-pages.append-wishlist-page')
                </div>
            </div>
        </div>
    </div>
</div>
<!--Wishlist Area End-->

@endsection