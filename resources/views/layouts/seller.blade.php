<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="stylesheet" href="{{asset('seller/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('seller/assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{asset('seller/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('seller/assets/images/logo/favicon.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('seller/assets/css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('seller/assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{asset('seller/assets/css/pages/simple-datatables.css')}}">
    <link rel="stylesheet" href="{{asset('seller/assets/extensions/toastify-js/src/toastify.css')}}">
    <link rel="stylesheet" href="{{asset('seller/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('admin/js/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <style>
        .fontawesome-icons {
            text-align: center;
        }

        article dl {
            background-color: rgba(0, 0, 0, .02);
            padding: 20px;
        }

        .fontawesome-icons .the-icon {
            font-size: 24px;
            line-height: 1.2;
        }
    </style>

</head>

<body>
    <div id="app">
        <!--- sidebar ---->
        @include('layouts.inc.seller_sidebar')
        <!--- sidebar ---->
        <div id="main">

            @yield('content')






            <!-- footer --->

            @include('layouts.inc.seller_footer')
            hello DEv Beta

            <!----- footer ---->


        </div>


    </div>

    <script src="{{asset('admin/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('seller/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('seller/assets/js/app.js')}}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{asset('seller/assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('seller/assets/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('seller/assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('seller/assets/js/pages/simple-datatables.js')}}"></script>
    <script src="{{asset('seller/js/custom.js')}}"></script>
    <script src="{{asset('seller/assets/extensions/toastify-js/src/toastify.js')}}"></script>
    <script src="{{asset('seller/assets/js/pages/toastify.js')}}"></script>

    <script src="{{asset('admin/js/sweetalert2/sweetalert2.min.js')}}"></script>


    @yield('script')

</body>

</html>