<!doctype html>
<html class="no-js')}}" lang="zxx">

<!-- index-431:41-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home Version Four || limupa - Digital Products Store ECommerce Bootstrap 4 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/material-design-iconic-font.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome-stars.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/meanmenu.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/slick.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/jquery-ui.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/venobox.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/nice-select.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/helper.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
    <!-- Modernizr js -->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="{{asset('frontend/frontend-custom.css')}}"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('backend/admin/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

    







</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">


        <!-- Begin Header Area -->
        @include('frontend.layouts.inc.frontend-header')
        <!-- Header Area End Here -->


        <!----- Main Content Start Herr ------->

        @yield('content')

        <!-----Main Content End Here ---------->





        <!-- Begin Footer Area -->
        @include('frontend.layouts.inc.frontend-footer')
        <!-- Footer Area End Here -->


        <!-- Begin Quick View | Modal Area -->
        <div class="modal fade modal-wrapper" id="exampleModalCenter">
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
                                            <img src="images/product/large-size/1.jpg" alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="images/product/large-size/2.jpg" alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="images/product/large-size/3.jpg" alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="images/product/large-size/4.jpg" alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="images/product/large-size/5.jpg" alt="product image">
                                        </div>
                                        <div class="lg-image">
                                            <img src="images/product/large-size/6.jpg" alt="product image">
                                        </div>
                                    </div>
                                    <div class="product-details-thumbs slider-thumbs-1">
                                        <div class="sm-image"><img src="images/product/small-size/1.jpg" alt="product image thumb"></div>
                                        <div class="sm-image"><img src="images/product/small-size/2.jpg" alt="product image thumb"></div>
                                        <div class="sm-image"><img src="images/product/small-size/3.jpg" alt="product image thumb"></div>
                                        <div class="sm-image"><img src="images/product/small-size/4.jpg" alt="product image thumb"></div>
                                        <div class="sm-image"><img src="images/product/small-size/5.jpg" alt="product image thumb"></div>
                                        <div class="sm-image"><img src="images/product/small-size/6.jpg" alt="product image thumb"></div>
                                    </div>
                                </div>
                                <!--// Product Details Left -->
                            </div>

                            <div class="col-lg-7 col-md-6 col-sm-6">
                                <div class="product-details-view-content pt-60">
                                    <div class="product-info">
                                        <h2>Today is a good day Framed poster</h2>
                                        <span class="product-details-ref">Reference: demo_15</span>
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
                                            <span class="new-price new-price-2">$57.98</span>
                                        </div>
                                        <div class="product-desc">
                                            <p>
                                                <span>100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                                </span>
                                            </p>
                                        </div>
                                        <div class="product-variants">
                                            <div class="produt-variants-size">
                                                <label>Dimension</label>
                                                <select class="nice-select">
                                                    <option value="1" title="S" selected="selected">40x60cm</option>
                                                    <option value="2" title="M">60x90cm</option>
                                                    <option value="3" title="L">80x120cm</option>
                                                </select>
                                            </div>
                                        </div>
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
                                            <div class="product-social-sharing pt-25">
                                                <ul>
                                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                    <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                                </ul>
                                            </div>
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




        <!--- Register Modal ------>

        <div class="modal fade modal-wrapper" id="registerModal" class="login-open">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="m-auto text-white">Register</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="modal-inner-area row">

                            <form action="{{route('user-register')}}" method="post" class="user_register_form_operation">
                                @csrf
                                <div class="login-form">

                                    <div class="success_message alert alert-success" style="display:none;"></div>
                                    <div class="error_message alert alert-danger" style="display:none;"></div>
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Full Name</label>
                                            <input class="mb-0" type="text" name="name" placeholder="Full Name">
                                            <span class="text-danger error-text name_error"></span>
                                        </div>

                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Phone</label>
                                            <input class="mb-0" type="text" name="phone" placeholder="Phone">
                                            <span class="text-danger error-text phone_error"></span>
                                        </div>

                                        <div class="col-md-12 mb-20">
                                            <label>Email Address*</label>
                                            <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <label>Password</label>
                                            <input class="mb-0" type="password" name="password" placeholder="Password">
                                            <span class="text-danger error-text password_error"></span>
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <label>Confirm Password</label>
                                            <input class="mb-0" type="password" name="conpassword" placeholder="Confirm Password">
                                            <span class="text-danger error-text conpassword_error"></span>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="register-button mt-0 w-100">Register  </button>

                                            

                                            

                                        </div>
                                    </div>
                                </div>








                            </form>
                        </div>

                    </div>



                </div>
            </div>



        </div>


        <!----- Register Modal End ------->



        <!-- Begin Login | Modal Area -->

        <div class="modal fade modal-wrapper" id="loginModal" class="login-open">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="m-auto text-white">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="modal-inner-area row">

                            <form action="{{route('check-user')}}" method="POST" class="user_login_form_operation">
                                @csrf
                                <div class="login-form">

                                    <div class="success_message alert alert-success" style="display:none;"></div>
                                    <div class="error_message alert alert-danger" style="display:none;"></div>
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Email Address*</label>
                                            <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Password</label>
                                            <input class="mb-0" type="password" name="password" placeholder="Password">
                                            <span class="text-danger error-text password_error"></span>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                                <input type="checkbox" id="remember_me">
                                                <label for="remember_me">Remember me</label>

                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                            <a href="javascript:void;" id="forgotpassword"> Forgotten passward?</a>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="register-button mt-0 w-100">Login</button>
                                        </div>

                                    </div>
                                </div>



                            </form>
                        </div>

                    </div>



                </div>
            </div>
        </div>


        <!-- Login | Modal Area End Here -->

        <!---- Forgot Password Modal------>

        <div class="modal fade modal-wrapper" id="ForgotPasswordModal" class="login-open">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="m-auto text-white">Forgot Passwword</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="modal-inner-area row">

                            <form action="{{route('forgot-password')}}" method="POST" class="forgot-password-form" style="width: 870px;">
                                @csrf
                                <div class="login-form">

                                    <div class="success_message alert alert-success" style="display:none;"></div>
                                    <div class="error_message alert alert-danger" style="display:none;"></div>
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <h3>Enter Your Email Address</h3>
                                            <label>Email Address*</label>
                                            <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>



                                        <div class="col-md-12">
                                            <button type="submit" class="register-button mt-0 w-100">Submit</button>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <a id="backtologin" class="register-button text-white text-center mt-0 w-100">Back To Login</a>
                                        </div>

                                    </div>
                                </div>



                            </form>
                        </div>

                    </div>



                </div>
            </div>
        </div>

        <!---- Forgot Password Modal End------>









    </div>


    <!-- Body Wrapper End Here -->
    <!-- jQuery-V1.12.4 -->
    <script src="{{asset('frontend/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('frontend/assets/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <!-- Ajax Mail js -->
    <script src="{{asset('frontend/assets/js/ajax-mail.js')}}"></script>
    <!-- Meanmenu js -->
    <script src="{{asset('frontend/assets/js/jquery.meanmenu.min.js')}}"></script>
    <!-- Wow.min js -->
    <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
    <!-- Slick Carousel js -->
    <script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
    <!-- Owl Carousel-2 js -->
    <script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
    <!-- Magnific popup js -->
    <script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Isotope js -->
    <script src="{{asset('frontend/assets/js/isotope.pkgd.min.js')}}"></script>
    <!-- Imagesloaded js -->
    <script src="{{asset('frontend/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Mixitup js -->
    <script src="{{asset('frontend/assets/js/jquery.mixitup.min.js')}}"></script>
    <!-- Countdown -->
    <script src="{{asset('frontend/assets/js/jquery.countdown.min.js')}}"></script>
    <!-- Counterup -->
    <script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('frontend/assets/js/waypoints.min.js')}}"></script>
    <!-- Barrating -->
    <script src="{{asset('frontend/assets/js/jquery.barrating.min.js')}}"></script>
    <!-- Jquery-ui -->
    <script src="{{asset('frontend/assets/js/jquery-ui.min.js')}}"></script>
    <!-- Venobox -->
    <script src="{{asset('frontend/assets/js/venobox.min.js')}}"></script>
    <!-- Nice Select js -->
    <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('frontend/assets/js/scrollUp.min.js')}}"></script>
    <!-- Main/Activator js -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>
    <script src="{{asset('frontend/frontend-custom.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('backend/admin/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

   

    @yield('script')


</body>

<!-- index-431:47-->

</html>