<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin/vendors/images/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin/vendors/images/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/vendors/images/favicon-16x16.png')}}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/core.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/icon-font.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/style.css')}}" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('admin/js/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('admin/js/toastr/toastr.min.css')}}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="{{asset('admin/vendors/images/deskapp-logo.svg')}}" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> -->

    <!---  Header Start ---->
    @include('layouts.inc.admin-header')
    <!---  Header End ---->



    <!---  Sidebar Start ---->
    @include('layouts.inc.admin-sidebar')
    <!---  Sidebar End ---->


    <!---- main Content --->
    <div class="main-container">
        @yield('content')


    </div>
    <!---- main Content End --->



    <!-- js -->

    <script src="{{asset('admin/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/layout-settings.js')}}"></script>
    <script src="{{asset('admin/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/dashboard3.js')}}"></script>
    <script src="{{asset('admin/src/plugins/jquery-steps/jquery.steps.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/steps-setting.js')}}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{asset('admin/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
    <!-- SweetAlert2 -->

    <script src="{{asset('admin/js/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('admin/js/toastr/toastr.min.js')}}"></script>
    <!-- Datatable Setting js -->
    <script src="{{asset('admin/vendors/scripts/datatable-setting.js')}}"></script>
    <script src="{{asset('admin/js/custom.js')}}"></script>

    @yield('script')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>