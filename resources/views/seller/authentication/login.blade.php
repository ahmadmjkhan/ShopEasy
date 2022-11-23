<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Seller Login</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="{{asset('seller/vendors/styles/style.css')}}" />

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

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="vendors/images/deskapp-logo.svg" alt="" />
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="register.html">Register</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/login-page-img.png" alt="" />
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To Seller</h2>
						</div>
						<div class="success_message alert alert-success" style="display:none;"></div>
						<div class="error_message alert alert-danger" style="display:none;"></div>
						<form action="{{route('seller.check')}}" method="post" class="seller_login_form_operation">
							@csrf
							<!-- <div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin" />
										<div class="icon">
											<img src="vendors/images/briefcase.svg" class="svg" alt="" />
										</div>
										<span>I'm</span>
										Manager
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user" />
										<div class="icon">
											<img src="vendors/images/person.svg" class="svg" alt="" />
										</div>
										<span>I'm</span>
										Employee
									</label>
								</div>
							</div> -->
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email" name="email" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>

							</div>
							<span class="text-danger error-text email_error"></span>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********" name="password" />

								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>

								</div>

							</div>
							<span class="text-danger error-text password_error"></span>

							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1" />
										<label class="custom-control-label" for="customCheck1">Remember</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password">
										<a href="forgot-password.html">Forgot Password</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<button type="submit" class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</button>
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
										OR
									</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="{{route('seller.register')}}">Register To Create Account</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- js -->
	<script src="{{asset('seller/vendors/scripts/core.js')}}"></script>
	<script src="{{asset('seller/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('seller/vendors/scripts/process.js')}}"></script>
	<script src="{{asset('seller/vendors/scripts/layout-settings.js')}}"></script>
	<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
	<script>
		$(document).ready(function() {

			$(document).on('submit', '.seller_login_form_operation', function(e) {


				e.preventDefault();

				let url = $(this).attr('action');


				let data = new FormData($('.seller_login_form_operation')[0]);
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
							$('.seller_login_form_operation')[0].reset();

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
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
</body>

</html>