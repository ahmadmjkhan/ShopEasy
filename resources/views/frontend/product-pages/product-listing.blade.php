<?php

use App\Models\Section;

$all_sections = Section::sections();

?>
@extends('frontend.layouts.frontend-master-layout')

@section('content')

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <?php echo $categoryDetails['breadcrumb']; ?>
                
            </ul>
        </div>


    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Li's Content Wraper Area -->
<div class="content-wraper pt-60 pb-60 pt-sm-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-1 order-lg-2">
                @if(!isset($_REQUEST['search']))
                <!-- Begin Li's Banner Area -->
                <div class="single-banner shop-page-banner">
                    <a href="#">
                        <img src="{{asset('frontend/assets/images/bg-banner/2.jpg')}}" alt="Li's Static Banner">
                    </a>
                </div>
                <!-- Li's Banner Area End Here -->
                
                @endif
                <!-- shop-top-bar start -->

                <div class="shop-top-bar mt-30">
                    <h4><?php  echo $categoryDetails['categoryDetails']['description']; ?></h4>
                    <div class="shop-bar-inner">
                        <div class="product-view-mode">
                            <!-- shop-item-filter-list start -->
                            <ul class="nav shop-item-filter-list" role="tablist">
                                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                            </ul>
                            <!-- shop-item-filter-list end -->
                        </div>
                        <div class="toolbar-amount">
                            <span></span>
                        </div>
                    </div>
                    <!-- product-select-box start -->
                    @if(!isset($_REQUEST['search']))
                    <div class="product-select-box">
                        <div class="product-short">
                            <form name="sortProduct" id="sortProducts">
                                <input type="hidden" name="url" id="url" value="{{ $url }}">
                                <p>Sort By:</p>
                                <select name="sort" id="sort" class="nice-select">
                                    <option value="product-latest">Latest Products</option>

                                    <option value="price-lowest">Price (Low &lt; High)</option>
                                    <option value="price-highest">Price (High &gt; Low)</option>
                                    <option value="name_a_z">Name (A - Z)</option>
                                    <option value="name_z_a">Name (Z - A)</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    @endif
                    <!-- product-select-box end -->
                </div>
                <!-- shop-top-bar end -->




                <div class="filter-products ">
                    @include('frontend.product-pages.ajax-product-listing')
                </div>






                @if(!isset($_REQUEST['search']))
                <div class="paginatoin-area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 pt-xs-15">
                            <p>Showing 1-12 of {{$categoryProducts->count()}}</p>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <ul class="pagination-box pt-xs-20 pb-xs-15">
                                <!-- <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li>
                                    <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                                </li> -->
                                {{$categoryProducts->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div>


            <div class="col-lg-3 order-2 order-lg-1">
                @include('frontend.layouts.inc.frontend-product-filter')
            </div>
        </div>
    </div>
</div>
<!-- Content Wraper Area End Here -->






@endsection