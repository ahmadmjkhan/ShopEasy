<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seller Registration</title>

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
    <link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/src/plugins/jquery-steps/jquery.steps.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('backend/seller/assets/vendors/styles/style.css')}}" />
    <link rel="stylesheet" href="{{asset('backend/seller/seller-custom.css')}}">

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
                    <img src="{{asset('backend/seller/assets/vendors/images/deskapp-logo.svg')}}" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="{{route('seller.login')}}">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{asset('backend/seller/assets/vendors/images/register-page-img.png')}}" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Bank Details</h2>
                        </div>
                        <div class="success_message alert alert-success" style="display:none;"></div>
                        <div class="error_message alert alert-danger" style="display:none;"></div>
                        <form action="{{route('seller.bank-details-store')}}" method="post" class="all_details_form_operation">
                            @csrf
                            <!-- <div class="select-role">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons"> -->
                            <!-- <label class="btn active">
                                        <input type="radio" name="options" id="admin" />
                                        <div class="icon">
                                            <img src="{{asset('backend/seller/assets/vendors/images/briefcase.svg')}}" class="svg" alt="" />
                                        </div>
                                        <span>I'm</span>
                                        Manager
                                    </label>
                                    <label class="btn">
                                        <input type="radio" name="options" id="user" />
                                        <div class="icon">
                                            <img src="{{asset('backend/seller/assets/vendors/images/person.svg')}}" class="svg" alt="" />
                                        </div>
                                        <span>I'm</span>
                                        Employee
                                    </label> -->
                            <!-- </div>
                            </div> -->

                            <div class="form-group row align-items-center">
                                <label class="col-sm-4 col-form-label">Account Type</label>
                                <div class="col-sm-8">
                                    <div class="custom-control custom-radio custom-control-inline pb-0">
                                        <input type="radio" id="male" name="account_type" class="custom-control-input" value="Saving" />
                                        <label class="custom-control-label" for="male">Saving</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline pb-0">
                                        <input type="radio" id="female" name="account_type" class="custom-control-input" value="Current" />
                                        <label class="custom-control-label" for="female">Current</label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Account Holder Name" name="account_holder_name" value="" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>

                            </div>
                            <span class="text-danger error-text address_error"></span>
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Enter Bank Name" name="bank_name" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>

                            </div>

                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Enter Your Account Number" name="account_number" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>

                            </div>

                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Bank IFSC Code" name="bank_ifsc_code" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>

                            </div>






                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->

                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html Start -->
    <button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">
        Launch modal
    </button>
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-width-400" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center">
                        <img src="vendors/images/success.png" />
                    </div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                    eiusmod
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="login.html" class="btn btn-primary">Done</a>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html End -->

    <!-- Spinner Area -->

    <div id="spinner-container" class="div-container" style="display:none;">
        <svg viewBox="0 0 100 100">
            <defs>
                <filter id="shadow">
                    <feDropShadow dx="0" dy="0" stdDeviation="1.5" flood-color="#fc6767" />
                </filter>
            </defs>
            <circle id="spinner" style="fill:transparent;stroke:#dd2476;stroke-width: 7px;stroke-linecap: round;filter:url(#shadow);" cx="50" cy="50" r="45" />
        </svg>
    </div>


    <!-- spinner Area end -->

    <!-- js -->
    <script src="{{asset('backend/seller/assets/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('backend/seller/assets/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('backend/seller/assets/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('backend/seller/assets/vendors/scripts/layout-settings.js')}}"></script>
    <script src="{{asset('backend/seller/assets/src/plugins/jquery-steps/jquery.steps.js')}}"></script>
    <script src="{{asset('backend/seller/assets/vendors/scripts/steps-setting.js')}}"></script>
    <script src="{{asset('backend/seller/seller-custom.js')}}"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>