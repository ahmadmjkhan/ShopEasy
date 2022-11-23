<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset('admin/assets/css/main/app.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/pages/auth.css')}}">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo/favicon.png')}}" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <!-- <div class="auth-logo">
                <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a>
            </div> -->
                    <h1 class="auth-title">Admin Login</h1>
                    <!-- <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p> -->
                    <div class="success_message alert alert-success" style="display:none"></div>
                    <div class="error_message alert alert-danger" style="display:none"></div>
                    <form action="{{route('admin.check')}}" method="post" class="admin_login_form_operation">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="email" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <span class="text-danger error-text password_error"></span>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="{{route('admin.register')}}" class="font-bold">Sign
                                up</a>.</p>
                        
                        <p><a class="font-bold" href="{{ route('admin.forgot_password_create') }}">Forgot password?</a>.</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>

    <script src="{{asset('admin/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/script.min.js')}}"></script>

    <script>
        $(document).ready(function() {

            $(document).on('submit', '.admin_login_form_operation', function(e) {

              
                e.preventDefault();


                let url = $(this).attr('action');


                let data = new FormData($('.admin_login_form_operation')[0]);
                $.ajax({
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
                            $('.admin_login_form_operation')[0].reset();

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

</html>