<?php

use App\Models\ProductFilter;

$ProductFilter = ProductFilter::productFilters();


?>
    <!--sidebar-categores-box start  -->
    <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
        <div class="sidebar-title">
            <h2>Laptop</h2>
        </div>
        <!-- category-sub-menu start -->
        <div class="category-sub-menu">
            <ul>
                <li class="has-sub"><a href="# ">Prime Video</a>
                    <ul>
                        <li><a href="#">All Videos</a></li>
                        <li><a href="#">Blouses</a></li>
                        <li><a href="#">Evening Dresses</a></li>
                        <li><a href="#">Summer Dresses</a></li>
                        <li><a href="#">T-Rent or Buy</a></li>
                        <li><a href="#">Your Watchlist</a></li>
                        <li><a href="#">Watch Anywhere</a></li>
                        <li><a href="#">Getting Started</a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#">Computer</a>
                    <ul>
                        <li><a href="#">TV & Video</a></li>
                        <li><a href="#">Audio & Theater</a></li>
                        <li><a href="#">Camera, Photo</a></li>
                        <li><a href="#">Cell Phones</a></li>
                        <li><a href="#">Headphones</a></li>
                        <li><a href="#">Video Games</a></li>
                        <li><a href="#">Wireless Speakers</a></li>
                    </ul>
                </li>
                <li class="has-sub"><a href="#">Electronics</a>
                    <ul>
                        <li><a href="#">Amazon Home</a></li>
                        <li><a href="#">Kitchen & Dining</a></li>
                        <li><a href="#">Bed & Bath</a></li>
                        <li><a href="#">Appliances</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- category-sub-menu end -->
    </div>
    <!--sidebar-categores-box end  -->
    <!--sidebar-categores-box start  -->
    <div class="sidebar-categores-box">
        <div class="sidebar-title">
            <h2>Filter By</h2>
        </div>
        <!-- btn-clear-all start -->
        <button class="btn-clear-all mb-sm-30 mb-xs-30 clear-btn" >Clear all</button>
        <!-- btn-clear-all end -->
        <!-- filter-sub-area start -->
        @if(!isset($_REQUEST['search']))
        <?php  $getBrands = ProductFilter::getBrands($url); ?>
        <div class="filter-sub-area">
            <h5 class="filter-sub-titel">Brands</h5>
            <div class="categori-checkbox">
                <form action="#">
                    <ul>
                        @foreach($getBrands as $key => $brand)
                        <li><input type="checkbox" class="brand" name="brand[]"  id="brand{{$key}}" value="{{$brand['id']}}">
                        <label for="brand{{$key}}">{{$brand['brand_name']}}</label>
                         </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
        @endif
        <!-- filter-sub-area end -->


        <!-- filter-sub-area start -->
        <div class="filter-sub-area pt-sm-10 pt-xs-10">
            <h5 class="filter-sub-titel">Price Range</h5>
            <div class="categori-checkbox">
                <form action="#" method="post">
                    <ul>
                        <?php $prices = array('0-1000','1000-2000','2000-5000','5000-10000','10000-1000000')  ?>
                        @foreach($prices as $key => $price)
                        <li><input type="checkbox" class="price" id="price{{$key}}" name="price[]" value="{{$price}}">
                        <label for="price{{$key}}">Rs. {{$price}}</label>
                        @endforeach
                      </li>
                       
                    </ul>
                </form>
            </div>
        </div>
        <!-- filter-sub-area end -->

        <!-- filter-sub-area start -->

        @if(!isset($_REQUEST['search']))
        <?php  $getSizes = ProductFilter::getSizes($url); ?>
        <div class="filter-sub-area pt-sm-10 pt-xs-10">
            <h5 class="filter-sub-titel">Sizes</h5>
            <div class="size-checkbox">
                <form action="#">
                    <ul>
                        @foreach($getSizes as $key => $size)
                        <li><input type="checkbox" class="size" name="size[]" id="size{{$key}}" value="{{$size}}">
                        <label for="size{{$key}}">{{$size}}</label>
                        </li>
                        
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
        @endif
        <!-- filter-sub-area end -->
        <!-- filter-sub-area start -->
        @if(!isset($_REQUEST['search']))
        <?php  $getColors = ProductFilter::getColors($url); ?>
        <div class="filter-sub-area pt-sm-10 pt-xs-10">
            <h5 class="filter-sub-titel">Colors</h5>
            <div class="categori-checkbox">
                <form action="#">
                    <ul>
                        @foreach($getColors  as $key => $color)
                        <li><input type="checkbox" class="color" name="color[]" id="color{{$key}}" value="{{$color}}">
                        <label for="color{{$key}}">{{$color}}</label>
                        </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
        @endif
        <!-- filter-sub-area end -->
      

        @if(!isset($_REQUEST['search']))
         @foreach($ProductFilter as $filter)
         <?php   
          $filterAvailable = ProductFilter::filterAvailable($filter['id'],$categoryDetails['categoryDetails']['id']);
         ?>
        <!-- filter-sub-area start -->
        @if($filterAvailable == "Yes")
        @if(count($filter['filter_values'])>0)
        <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
            <h5 class="filter-sub-titel">{{$filter['filter_name']}}</h5>
            <div class="categori-checkbox">
                <form action="#" method="post">
                    <ul>
                        @foreach($filter['filter_values'] as $value)
                        <li><input type="checkbox" class="{{$filter['filter_column']}}" name="{{$filter['filter_column']}}[]" id="{{$value['filter_value']}}" value="{{$value['filter_value']}}"><label for="{{$value['filter_value']}}">{{ucwords($value['filter_value'])}}</label></li>
                      
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
        @endif
        @endif
        <!-- filter-sub-area end -->
        @endforeach
        @endif




       
    </div>
    <!--sidebar-categores-box end  -->
    <!-- category-sub-menu start -->
    <div class="sidebar-categores-box mb-sm-0">
        <div class="sidebar-title">
            <h2>Laptop</h2>
        </div>
        <div class="category-tags">
            <ul>
                <li><a href="# ">Devita</a></li>
                <li><a href="# ">Cameras</a></li>
                <li><a href="# ">Sony</a></li>
                <li><a href="# ">Computer</a></li>
                <li><a href="# ">Big Sale</a></li>
                <li><a href="# ">Accessories</a></li>
            </ul>
        </div>
        <!-- category-sub-menu end -->
    </div>

