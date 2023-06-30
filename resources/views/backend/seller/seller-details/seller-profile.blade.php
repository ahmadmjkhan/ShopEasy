@extends('backend.seller.layouts.seller-master-layout')

@section('content')


<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Profile</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Profile
                            </li>
                        </ol>
                    </nav>



                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                        <img src="{{asset('uploads/seller/seller_avatar/'.$sellerPersonalDetails->seller_image)}}" alt="" class="avatar-photo" />
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{route('seller.profile')}}" method="POST" enctype="multipart/form-data" class="form_operation">
                                        @csrf

                                        <input type="hidden" name="tab" value="profilepic">
                                        <div class="modal-body pd-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="img-container">
                                                        <img id="image" src="{{asset('uploads/seller/seller_avatar/'.$sellerPersonalDetails->seller_image)}}" alt="Picture" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mt-3">
                                                        <label for="">Upload Pic</label>
                                                        <input type="file" name="seller_image" class="form-control-file">
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="success_message alert alert-success" style="display:none; width:100%;"></div>
                                                    <div class="error_message alert alert-danger" style="display:none;"></div>

                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-center h5 mb-0">{{$sellerPersonalDetails->name}}</h5>
                    <p class="text-center text-muted font-14">
                        {{$sellerBussinessDetails->shop_name}}
                    </p>
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                        <ul>
                            <li>
                                <span>Email Address:</span>
                                {{$sellerPersonalDetails->email}}
                            </li>
                            <li>
                                <span>Phone Number:</span>
                                {{$sellerPersonalDetails->phone}}
                            </li>
                            <li>
                                <span>Country:</span>
                                {{$sellerPersonalDetails->country}}
                            </li>
                            <li>
                                <span>Address:</span>
                                {{$sellerPersonalDetails->address}}<br />
                                {{$sellerPersonalDetails->city}}, {{$sellerPersonalDetails->state}}
                            </li>
                        </ul>
                    </div>
                    <div class="profile-social">
                        <h5 class="mb-20 h5 text-blue">Social Links</h5>
                        <ul class="clearfix">
                            <li>
                                <a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a>
                            </li>


                            <li>
                                <a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fa fa-skype"></i></a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="tab height-100-p">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#bussiness" role="tab">Bussiness</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#bank" role="tab">Bank </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Personal Details Tab start -->
                                <div class="tab-pane fade show active" id="personal" role="tabpanel">

                                    <div class="pd-20">
                                        @if(Session::has('error_message'))

                                        <span class="alert alert-danger mb-3">
                                            {{Session::get('error_message')}}
                                        </span>
                                        @endif

                                        @if(Session::has('success_message'))

                                        <span class="alert alert-success mb-3">
                                            {{Session::get('success_message')}}
                                        </span>
                                        @endif
                                        <div class="profile-timeline">

                                            <!-- <div class="success_message alert alert-success" style="display:none;"></div>
                                            <div class="error_message alert alert-danger" style="display:none;"></div> -->
                                            <form action="{{route('seller.profile')}}" method="POST">
                                                @csrf

                                                <input type="hidden" name="tab" value="personal">

                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-12">
                                                        <h4 class="text-blue text-center h5 mb-20">
                                                            Edit Your Personal Details
                                                        </h4>
                                                        <div class="form-group">
                                                            <label>Full Name</label>
                                                            <input class="form-control form-control-lg" type="text" name="name" value="{{$sellerPersonalDetails->name}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control form-control-lg" type="text" name="email" value="{{$sellerPersonalDetails->email}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input class="form-control form-control-lg" type="text" name="address" value="{{$sellerPersonalDetails->address}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input class="form-control form-control-lg" type="text" name="city" value="{{$sellerPersonalDetails->city}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <input class="form-control form-control-lg" type="text" name="state" value="{{$sellerPersonalDetails->state}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Postal Code</label>
                                                            <input class="form-control form-control-lg" type="text" name="pincode" value="{{$sellerPersonalDetails->pincode}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input class="form-control form-control-lg" type="text" name="phone" value="{{$sellerPersonalDetails->phone}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select class="selectpicker form-control form-control-lg" name="country" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
                                                                <option value="USA" @if(!empty($sellerPersonalDetails->country) && $sellerPersonalDetails->country == 'USA') selected="" @endif>United States of America</option>
                                                                <option value="India" @if(!empty($sellerPersonalDetails->country) && $sellerPersonalDetails->country == 'India') selected="" @endif>India</option>
                                                                <option value="Pakistan" @if(!empty($sellerPersonalDetails->country) && $sellerPersonalDetails->country == 'Pakistan') selected="" @endif>Pakistan</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="customRadio4" name="gender" value="male" class="custom-control-input" {{$sellerPersonalDetails->gender == 'male' ? 'checked' : ''}} />
                                                                    <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio5" name="gender" value="female" class="custom-control-input" {{$sellerPersonalDetails->gender == 'female' ? 'checked' : ''}} />
                                                                    <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary" value="Update Information" />
                                                        </div>
                                                    </li>

                                                </ul>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- Personal Details Tab End -->
                                <!-- Bussiness Details Tab start -->
                                <div class="tab-pane fade" id="bussiness" role="tabpanel">

                                    <div class="pd-20">

                                        <div class="profile-setting">

                                            <!-- <div class="success_message alert alert-success" style="display:none;"></div>
                                        <div class="error_message alert alert-danger" style="display:none;"></div> -->
                                            <form action="{{route('seller.profile')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="tab" value="bussiness">
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-12">
                                                        <h4 class="text-blue text-center h5 mb-20">
                                                            Edit Your Bussiness Details
                                                        </h4>

                                                        <div class="form-group">
                                                            <label>Shop Name</label>
                                                            <input class="form-control form-control-lg" type="text" name="shop_name" value="{{$sellerBussinessDetails->shop_name}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Shop Email</label>
                                                            <input class="form-control form-control-lg" type="email" name="shop_email" value="{{$sellerBussinessDetails->shop_email}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Shop Address</label>
                                                            <input class="form-control form-control-lg" type="text" name="shop_address" value="{{$sellerBussinessDetails->shop_address}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Shop City</label>
                                                            <input class="form-control form-control-lg" type="text" name="shop_city" value="{{$sellerBussinessDetails->shop_city}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Shop State</label>
                                                            <input class="form-control form-control-lg" type="text" name="shop_state" value="{{$sellerBussinessDetails->shop_state}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select class="selectpicker form-control form-control-lg" name="shop_country" data-style="btn-outline-secondary btn-lg" title="Not Chosen">
                                                                <option value="USA" @if(!empty($sellerBussinessDetails->shop_country) && $sellerBussinessDetails->shop_country == 'USA') selected="" @endif>United States of America</option>
                                                                <option value="India" @if(!empty($sellerBussinessDetails->shop_country) && $sellerBussinessDetails->shop_country == 'India') selected="" @endif>India</option>
                                                                <option value="Pakistan" @if(!empty($sellerBussinessDetails->shop_country) && $sellerBussinessDetails->shop_country == 'Pakistan') selected="" @endif>Pakistan</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Shop Pincode</label>
                                                            <input class="form-control form-control-lg" type="text" name="shop_pincode" value="{{$sellerBussinessDetails->shop_pincode}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Shop Mobile</label>
                                                            <input class="form-control form-control-lg" type="text" name="shop_mobile" value="{{$sellerBussinessDetails->shop_mobile}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Shop Website</label>
                                                            <input class="form-control form-control-lg" type="text" name="shop_website" value="{{$sellerBussinessDetails->shop_website}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Address Proof</label>
                                                            <input class="form-control form-control-lg" type="text" name="address_proof" value="{{$sellerBussinessDetails->address_proof}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Business License Number</label>
                                                            <input class="form-control form-control-lg" type="text" name="bussiness_license_number" value="{{$sellerBussinessDetails->bussiness_license_number}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gst Number</label>
                                                            <input class="form-control form-control-lg" type="text" name="gst_number" value="{{$sellerBussinessDetails->gst_number}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>PAN Number</label>
                                                            <input class="form-control form-control-lg" type="text" name="pan_number" value="{{$sellerBussinessDetails->pan_number}}" />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Address Proof Image</label><br>

                                                            @if(!empty($sellerBussinessDetails->address_proof_image))
                                                            <img src="{{asset('uploads/seller/address_proof_image/'.$sellerBussinessDetails->address_proof_image)}}" alt=""><br>
                                                            <input class="form-control form-control-lg" type="file" name="address_proof_image" />
                                                            @else
                                                            <input class="form-control form-control-lg" type="file" name="address_proof_image" />
                                                            @endif
                                                        </div>





                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary" value="Update Information" />
                                                        </div>
                                                    </li>

                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bussiness Details Tab End -->
                                <!-- Bank Details Tab start -->
                                <div class="tab-pane fade height-100-p" id="bank" role="tabpanel">
                                    <div class="pd-20">
                                        @if(Session::has('error_message'))

                                        <span class="alert alert-danger mb-3 ">
                                            {{Session::get('error_message')}}
                                        </span>
                                        @endif

                                        @if(Session::has('success_message'))

                                        <span class="alert alert-success mb-3">
                                            {{Session::get('success_message')}}
                                        </span>
                                        @endif
                                        <div class="profile-setting">
                                            <!-- <div class="success_message alert alert-success" style="display:none;"></div>
                                        <div class="error_message alert alert-danger" style="display:none;"></div> -->

                                            <form action="{{route('seller.profile')}}" method="POST">
                                                @csrf

                                                <input type="hidden" name="tab" value="bank">
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-12">
                                                        <h4 class="text-blue text-center h5 mb-20">
                                                            Edit Your Bank Details
                                                        </h4>


                                                        <div class="form-group">
                                                            <label class="weight-600">Account Type</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio1" name="account_type" class="custom-control-input" value="Saving" {{$sellerBankDetails->account_type == "Saving" ? "checked" : ""}} />
                                                                    <label class="custom-control-label" for="customRadio1">Saving</label>
                                                                </div>

                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio2" name="account_type" class="custom-control-input" value="Current" {{$sellerBankDetails->account_type == "Current" ? "checked" : ""}} />
                                                                    <label class="custom-control-label" for="customRadio2">Current</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="form-group">
                                                            <label>Account Holder Name</label>
                                                            <input class="form-control form-control-lg" type="text" name="account_holder_name" value="{{$sellerBankDetails->account_holder_name}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Bank Name</label>
                                                            <input class="form-control form-control-lg" type="text" name="bank_name" value="{{$sellerBankDetails->bank_name}}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Account Number</label>
                                                            <input class="form-control form-control-lg" type="text" name="account_number" value="{{$sellerBankDetails->account_number}}" />
                                                        </div>


                                                        <div class="form-group">
                                                            <label>Bank IFSC Code</label>
                                                            <input class="form-control form-control-lg" type="text" name="bank_ifsc_code" value="{{$sellerBankDetails->bank_ifsc_code}}" />
                                                        </div>

                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary" value="Update Information" />
                                                        </div>
                                                    </li>

                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bank Details Tab End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection