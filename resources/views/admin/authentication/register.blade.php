<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registeration</title>
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
                    @if(Session::get('success'))
                    <div>
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::get('fail'))
                    <div>
                        {{Session::get('fail')}}
                    </div>
                    @endif
                    <!-- <div class="auth-logo">
                <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a>
            </div> -->
                    <h1 class="auth-title">Admin Registration</h1>
                    <div class="success_message"></div>
                    <div class="error_message"></div>

                    <!-- <p class="auth-subtitle mb-5">Input your data to register to our website.</p> -->

                    <form action="{{route('admin.create')}}" method="post" class="admin_register_form_operation">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="name" placeholder="Name" value="{{old('name')}}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <span class="text-danger error-text name_error"></span>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="email" placeholder="Email" value="{{old('email')}}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <select name="type" id="" class="form-select">
                                <option value="">Select Type</option>
                                <option value="admin">Admin</option>
                                <option value="subadmin">SubAdmin</option>
                                
                            </select>
                            
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" value="{{old('password')}}">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <span class="text-danger error-text password_error"></span>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Confirm Password" name="conpassword" value="{{old('conpassword')}}">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <span class="text-danger error-text conpassword_error"></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="{{route('admin.login')}}" class="font-bold">Log
                                in</a>.</p>
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

            $(document).on('submit', '.admin_register_form_operation', function(e) {
           
                
                e.preventDefault();
                

                let url = $(this).attr('action');


                let data = new FormData($('.admin_register_form_operation')[0]);
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
                            $('.admin_register_form_operation')[0].reset();

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