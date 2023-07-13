<!doctype html>
<html class="no-js')}}" lang="zxx">

<!-- index-431:41-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(!empty($meta_title))
    <title>{{$meta_title}}</title>
    @else
    <title>ShopEasy is A shopping Website</title>
    @endif
    @if(!empty($meta_description))
    <meta name="description" content="{{$meta_description}}">
    @else
    <meta name="description" content="This is a shopping website where you can sell and buy products">
    @endif
    @if(!empty($meta_keyword))
    <meta name="keywords" content="{{$meta_keyword}}">
    @else
    <meta name="keywords" content="Clothing,Mobiles,Fashion products">
    @endif
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




        <!-- Modals Footer Area -->
        @include('frontend.layouts.inc.frontend-modals')

        <!-- Modals Area End Here -->






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
    <!-- script of filter products --->
    <script src="{{asset('frontend/frontend-filter.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('backend/admin/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AT_8WRxJY42S9ud6TXog9fdwMexQ2nOURp-OK2KCiqeGzfto7_tDMntSWKV2o5g9mpjohr6-D_iRS8LP"></script>


    <!-- Load jQuery library -->
    <script type="text/javascript">
        $(function() {
            $('.btnQuickView').on('click', function(e) {
                alert('hello hbh');
                e.preventDefault();
                var data = $(this).data();
                alert(data);
                console.log(data);
                $('#quickViewModal #modal-product-name').html(data.productName);
                $('#quickViewModal #modal-product-category').html(data.productCategory);
                $('#quickViewModal #modal-product-description').html(data.productDescription);
                $('#quickViewModal #modal-product-image').attr('src', data.productImg);
                $('#quickViewModal #modal-product-price').html('Rs '+data.productPrice);
                $('#quickViewModal #modal-product-short-description').html(data.productShortDescription);

                $('#quickViewModal').modal();
            });
        });
    </script>

    <!--- used to include script blade of filters operation --->
    @include('frontend.script')
    <!--- used to include script blade of filters operation --->


    @yield('script')


</body>

<!-- index-431:47-->

</html>