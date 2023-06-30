<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Seller Admin</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('backend/seller/assets/vendors/images/apple-touch-icon.png')}}" />
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('backend/seller/assets/vendors/images/favicon-32x32.png')}}" />
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('backend/seller/assets/vendors/images/favicon-16x16.png')}}" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/vendors/styles/core.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/vendors/styles/icon-font.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/vendors/styles/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/src/plugins/jquery-steps/jquery.steps.css')}}" />
	<!---- Sweet Alert ----->
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="{{asset('backend/admin/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
	
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
					<img src="{{asset('seller/assets/vendors/images/deskapp-logo.svg')}}" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Loading...</div>
			</div>
		</div> -->

	<!------ HEADER START ------------->
	@include('backend.seller.layouts.inc.seller-header')
	<!------ HEADER END --------------->



	<!------- SIDEBAR START ------------>
	@include('backend.seller.layouts.inc.seller-sidebar')
	<!------- SIDEBAR END -------------->

	<div class="mobile-menu-overlay"></div>

	<!------ MAIN CONTENT START --------->
	<div class="main-container">
		<div class="pd-ltr-20">

			@yield('content')


			<!------ FOOTER START ----------->
			<div class="footer-wrap pd-20 mb-20 mt-5 card-box">
				ShopEasy &copy; copyright
				<a href="https://github.com/dropways" target="_blank"> Visit Website</a>
			</div>
			<!------- FOOTER END ------------->
		</div>
	</div>
	<!------ MAIN CONTENT END ----------->

	<!-- js -->
	<script src="{{asset('backend/seller/assets/vendors/scripts/core.js')}}"></script>
	<script src="{{asset('backend/seller/assets/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/vendors/scripts/process.js')}}"></script>
	<script src="{{asset('backend/seller/assets/vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/vendors/scripts/dashboard.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/jquery-steps/jquery.steps.js')}}"></script>
	<script src="{{asset('backend/seller/assets/vendors/scripts/steps-setting.js')}}"></script>
	<script src="{{asset('backend/seller/seller-custom.js')}}"></script>

	<!-- buttons for Export datatable -->
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('backend/seller/assets/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
	<!-- Datatable Setting js -->
	<script src="{{asset('backend/seller/assets/vendors/scripts/datatable-setting.js')}}"></script>

	<!-- SweetAlert2 -->
	<script src="{{asset('backend/admin/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>



	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


	</script>
</body>

</html>