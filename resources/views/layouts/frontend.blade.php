<!doctype html>
<html class="no-js" lang="zxx">

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
    <link rel="stylesheet" href="{{asset('frontend/css/material-design-iconic-font.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{asset('frontend/css/fontawesome-stars.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/meanmenu.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/venobox.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/helper.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <!-- Modernizr js -->
    <script src="{{asset('frontend/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">


        <!-- Begin Header Area -->
        @include('layouts.inc.frontend-header')
        <!-- Header Area End Here -->


        <!--- Main Content Start Here ---->

        @yield('content')

        <!--- Main Content End Here ---->

        <!-- Begin Footer Area -->

        @include('layouts.inc.frontend-footer')

        <!-- Footer Area End Here -->



        <!-- Begin Login | Modal Area -->
        <div class="modal fade modal-wrapper" id="loginModal" class="login-open">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area row">

                            <form action="{{route('user.check')}}" method="POST" class="user_login_form_operation">
                                <div class="login-form">
                                    <h4 class="login-title">Login</h4>
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
                                                <a href="{{route('user.register_index')}}">Sign UP</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                            <a href="#"> Forgotten pasward?</a>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="register-button mt-0">Login</button>
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
    </div>
    <!-- Body Wrapper End Here -->
    <!-- jQuery-V1.12.4 -->
    <script src="{{asset('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('frontend/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <!-- Ajax Mail js -->
    <script src="{{asset('frontend/js/ajax-mail.js')}}"></script>
    <!-- Meanmenu js -->
    <script src="{{asset('frontend/js/jquery.meanmenu.min.js')}}"></script>
    <!-- Wow.min js -->
    <script src="{{asset('frontend/js/wow.min.js')}}"></script>
    <!-- Slick Carousel js -->
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <!-- Owl Carousel-2 js -->
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    <!-- Magnific popup js -->
    <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Isotope js -->
    <script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
    <!-- Imagesloaded js -->
    <script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Mixitup js -->
    <script src="{{asset('frontend/js/jquery.mixitup.min.js')}}"></script>
    <!-- Countdown -->
    <script src="{{asset('frontend/js/jquery.countdown.min.js')}}"></script>
    <!-- Counterup -->
    <script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
    <!-- Barrating -->
    <script src="{{asset('frontend/js/jquery.barrating.min.js')}}"></script>
    <!-- Jquery-ui -->
    <script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
    <!-- Venobox -->
    <script src="{{asset('frontend/js/venobox.min.js')}}"></script>
    <!-- Nice Select js -->
    <script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>
    <!-- ScrollUp js -->
    <script src="{{asset('frontend/js/scrollUp.min.js')}}"></script>
    <!-- Main/Activator js -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="{{asset('frontend/custom.js')}}"></script>
    <script src="{{asset('frontend/js/sweetalert2@11.js')}}"></script>

    @yield('script')
    <script>
        $(document).ready(function() {

            $(document).on('submit', '.user_login_form_operation', function(e) {

                alert('helo');
                e.preventDefault();

                let url = $(this).attr('action');
                alert(url);


                let data = new FormData($('.user_login_form_operation')[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {

                        $(document).find('span.error-text').text('');
                    },

                    success: function(response) {

                        if (response.status == '0') {

                            $.each(response.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);

                            });

                        } else if (response.status == '2') {
                            // for invalid username and password show //
                            $('.error_message').show();
                            $('.error_message').html(response.message);

                            setTimeout(function() {
                                $('.error_message').fadeOut('slow');
                            }, 3000);
                        } else {
                            $('.user_login_form_operation')[0].reset();

                            $('.success_message').show();
                            $('.success_message').html(response.message);

                            // $(function() {
                            //     var Toast = Swal.mixin({
                            //         toast: true,
                            //         position: 'top-end',
                            //         showConfirmButton: false,
                            //         timer: 3000
                            //     });

                            //     Toast.fire({
                            //         icon: 'success',
                            //         title: response.message,
                            //     });

                            // });
                            // window.location=response.redirect_url; // for redirect location//
                            setTimeout(function() {
                                window.location = response.redirect_url;
                            }, 2000);
                        }

                    }
                });

            });
        });



       
    </script>
</body>

<!-- index-431:47-->

</html>