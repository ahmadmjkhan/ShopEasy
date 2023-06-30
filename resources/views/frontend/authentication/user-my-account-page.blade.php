
@extends('frontend.layouts.frontend-master-layout')

@section('content')
<div class="page-section mb-60">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <form action="{{route('user.my-account')}}" method="POST" class="myaccount_form_operation" enctype="multipart/form-data">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Update Account Details</h4>
                        <div class="success_message alert alert-success" style="display:none;"></div>
                        <div class="error_message alert alert-danger" style="display:none;"></div>
                        <div class="row">
                            <div class="col-md-12 mb-20">
                                <label>Email Address*</label>
                                <input class="mb-0" type="email" name="email" value="{{Auth::user()->email}}" placeholder="Email Address" readonly disabled style="background-color:gray;color:white">
                                <span class="text-danger error-text email_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Full Name</label>
                                <input class="mb-0" type="text" name="name" value="{{Auth::user()->name}}" placeholder="Full Name">
                                <span class="text-danger error-text name_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Phone</label>
                                <input class="mb-0" type="text" name="phone" value="{{Auth::user()->phone}}" placeholder="Phone">
                                <span class="text-danger error-text phone_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Address</label>
                                <input class="mb-0" type="text" name="address" value="{{Auth::user()->address}}" placeholder="Enter Address">
                                <span class="text-danger error-text address_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>City</label>
                                <input class="mb-0" type="text" name="city" value="{{Auth::user()->city}}" placeholder="Enter City">
                                <span class="text-danger error-text city_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>State</label>
                                <input class="mb-0" type="text" name="state" value="{{Auth::user()->state}}" placeholder="Enter State">
                                <span class="text-danger error-text state_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Country</label>
                                <input class="mb-0" type="text" name="country" value="{{Auth::user()->country}}" placeholder="Enter Country">
                                <span class="text-danger error-text country_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Phone</label>
                                <input class="mb-0" type="text" name="pincode" value="{{Auth::user()->pincode}}" placeholder="Enter Pincode">
                                <span class="text-danger error-text pincode_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Avatar</label>
                                <input class="mb-0" type="file" name="user_avatar">
                                <span class="text-danger error-text pincode_error"></span>

                                <img src="{{asset('uploads/user_avatar/'.$userDetails->user_avatar)}}" alt="NO Image" class="img-thumbnail mt-3">
                            </div>


                            <div class="col-12">
                                <button type="submit" class="register-button mt-0 w-100">Update Details</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                <form action="{{route('user.update-password')}}" method="POST" class="upadatepassword_form_operation">
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Update Password</h4>
                        <div class="password_success_message alert alert-success" style="display:none;"></div>
                        <div class="password_error_message alert alert-danger" style="display:none;"></div>
                        <div class="row">
                            <div class="col-md-12 mb-20">
                                <label>Current Password</label>
                                <input class="mb-0" type="password" name="current_password" placeholder="Enter Your Current Password">
                                <span class="text-danger error-text current_password_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>New Password</label>
                                <input class="mb-0" type="password" name="new_password" placeholder="Enter New Password">
                                <span class="text-danger error-text new_password_error"></span>
                            </div>

                            <div class="col-md-12 col-12 mb-20">
                                <label>Confirm Password</label>
                                <input class="mb-0" type="text" name="confirm_password" placeholder="Confirm Password">
                                <span class="text-danger error-text confirm_password_error"></span>
                            </div>




                        </div>
                        <div class="col-12">
                            <button type="submit" class="register-button mt-0 w-100">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>F

@endsection