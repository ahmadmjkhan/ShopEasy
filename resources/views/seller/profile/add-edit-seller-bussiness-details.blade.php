@extends('layouts.seller')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Bussiness Details</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form @if(!empty($bussinessdetails->seller_id)) action="{{url('seller/update-seller-bussiness-details',$bussinessdetails->seller_id)}}" @else action="{{url('seller/update-seller-bussiness-details')}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">

    
        @csrf

        @if(Session::has('error_message'))

        <span class="alert alert-danger ">
            {{Session::get('error_message')}}
        </span>
        @endif

        @if(Session::has('success_message'))

        <span class="alert alert-success ">
            {{Session::get('success_message')}}
        </span>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">


                    <div class="form-group">
                        <label for="exampleInputEmail1">Shop Name</label>
                        <input type="text" name="shop_name" class="form-control" id="exampleInputEmail1" @if(!empty($bussinessdetails->shop_name)) value="{{$bussinessdetails->shop_name}}" @else value="{{old('shop_name')}}" @endif>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Shop Email</label>

                        <input type="email" name="shop_email" class="form-control" id="exampleInputEmail1" @if(!empty($bussinessdetails->shop_email)) value="{{$bussinessdetails->shop_email}}" @else value="{{old('shop_email')}}" @endif>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Shop Mobile</label>
                        <input type="text" name="shop_mobile" class="form-control" @if(!empty($bussinessdetails->shop_mobile)) value="{{$bussinessdetails->shop_mobile}}" @else value="{{old('shop_mobile')}}" @endif>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Shop Address</label>
                        <input type="text" name="shop_address" class="form-control"@if(!empty($bussinessdetails->shop_address)) value="{{$bussinessdetails->shop_address}}" @else value="{{old('shop_address')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Shop City</label>
                        <input type="text" name="shop_city" class="form-control" @if(!empty($bussinessdetails->shop_city)) value="{{$bussinessdetails->shop_city}}" @else value="{{old('shop_city')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Shop State</label>
                        <input type="text" name="shop_state" class="form-control" @if(!empty($bussinessdetails->shop_state)) value="{{$bussinessdetails->shop_state}}" @else value="{{old('shop_state')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Shop Country</label>
                        <input type="text" name="shop_country" class="form-control" @if(!empty($bussinessdetails->shop_country)) value="{{$bussinessdetails->shop_country}}" @else value="{{old('shop_country')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Shop Pincode</label>
                        <input type="text" name="shop_pincode" class="form-control" @if(!empty($bussinessdetails->shop_pincode)) value="{{$bussinessdetails->shop_pincode}}" @else value="{{old('shop_pincode')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Shop Website</label>
                        <input type="text" name="shop_website" class="form-control" @if(!empty($bussinessdetails->shop_website)) value="{{$bussinessdetails->shop_website}}" @else value="{{old('shop_website')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Address Proof</label>
                        <select name="address_proof" id="" class="form-control">
                            <option value="PAN" > PAN</option>
                            <option value="Passport" > Passport</option>
                            <option value="Adhaar_Card" >Adhaar Card</option>
                            <option value="Driving_License"  >Driving License</option>
                        </select>

                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Address Proof Image</label>
                        
                        @if(!empty($bussinessdetails->address_proof_image))
                        <img src="{{url('uploads/images/seller-documents/'.$bussinessdetails->address_proof_image)}}" width="150" alt="">
                        <input type="file" name="address_proof_image" class="form-control" >
                        @else
                        <input type="file" name="address_proof_image" class="form-control" >
                        @endif
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bussiness License Number</label>
                        <input type="text" name="bussiness_license_number" class="form-control" @if(!empty($bussinessdetails->bussiness_license_number)) value="{{$bussinessdetails->bussiness_license_number}}" @else value="{{old('bussiness_license_number')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">GST Number</label>
                        <input type="text" name="gst_number" class="form-control" @if(!empty($bussinessdetails->gst_number)) value="{{$bussinessdetails->gst_number}}" @else value="{{old('gst_number')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">PAN Number</label>
                        <input type="text" name="pan_number" class="form-control" @if(!empty($bussinessdetails->pan_number)) value="{{$bussinessdetails->pan_number}}" @else value="{{old('pan_number')}}" @endif>
                        <span id="check_password"></span>
                    </div>
                </div>

            </div>





        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection