@extends('layouts.seller')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Your Bank Details</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form  @if(!empty($bankdetails->seller_id)) action="{{url('seller/update-seller-bank-details',$bankdetails->seller_id)}}" @else action="{{url('seller/update-seller-bank-details')}}" @endif enctype="multipart/form-data" method="post" class="form_operation">

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
                        <label for="exampleInputEmail1">Account Holder Name</label>
                        <input type="text" class="form-control" name="account_holder_name" id="exampleInputEmail1"  @if(!empty($bankdetails->account_holder_name)) value="{{$bankdetails->account_holder_name}}" @else value="{{old('account_holder_name')}}" @endif>
                    </div>
                    <span class="text-danger error-text account_holder_name_error"></span>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Bank Name</label>

                        <input type="text" name="bank_name" class="form-control" id="exampleInputEmail1" @if(!empty($bankdetails->bank_name)) value="{{$bankdetails->bank_name}}" @else value="{{old('bank_name')}}" @endif>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Account Number</label>
                        <input type="text" name="account_number" class="form-control" @if(!empty($bankdetails->account_number)) value="{{$bankdetails->account_number}}" @else value="{{old('account_number')}}" @endif>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bank IFSC Code</label>
                        <input type="text" name="bank_ifsc_code" class="form-control"@if(!empty($bankdetails->bank_ifsc_code)) value="{{$bankdetails->bank_ifsc_code}}" @else value="{{old('bank_ifsc_code')}}" @endif>
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