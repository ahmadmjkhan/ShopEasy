@extends('frontend.layouts.frontend-master-layout')

@section('content')

<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                <!-- Login Form s-->
                <div class="success_message alert alert-success" style="display:none;"></div>
                <div class="error_message alert alert-danger" style="display:none;"></div>
                <form action="{{route('user.forgot-password')}}" method="POST" class="forgot-password-form">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Forgot Password</h4>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Email Address*</label>
                                <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                <span class="text-danger error-text email_error"></span>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="register-button mt-0">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Login Content Area End Here -->




@endsection