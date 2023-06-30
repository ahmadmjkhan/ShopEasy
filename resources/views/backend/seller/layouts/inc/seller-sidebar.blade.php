<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{asset('seller/assets/vendors/images/deskapp-logo.svg')}}" alt="" class="dark-logo" />
            <img src="{{asset('seller/assets/vendors/images/deskapp-logo-white.svg')}}" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-textarea-resize"></span><span class="mtext">Products</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('seller.product_index')}}">All Products</a></li>
                        <li><a href="{{route('seller.add-edit-products')}}form-basic.html">Add Products</a></li>

                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-house"></span><span class="mtext">Coupons</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('seller.seller_coupon_index')}}">All Coupons</a></li>
                        <li><a href="index.html">Add Coupons</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-textarea-resize"></span><span class="mtext">Orders</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('seller.orders')}}">All Orders</a></li>


                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-hdd-stack"></span><span class="mtext">Multi Level Menu</span>
                    </a>
                    <ul class="submenu">

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="javascript:;">Level 2</a></li>
                                <li><a href="javascript:;">Level 2</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Extra</div>
                </li>

            </ul>
        </div>
    </div>
</div>