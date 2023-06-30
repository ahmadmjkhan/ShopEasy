@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Charges
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>{{$title}}</b><a href="{{route('admin.shipping-charges')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('admin.add-edit-shipping-charges',$shippingchargedetails['id'])}}" method="post" class="form_operation">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="">Country</label>
                        <select name="country_id" id="country_id" class="form-control" readonly>


                            <option value="{{$shippingchargedetails['id']}}" @if(!empty($shippingchargedetails['country'])) @endif>{{$shippingchargedetails['country']}}</option>

                        </select>
                        <span class="text-danger error-text section_id_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Rate (0-500g)</label>
                        <input type="text" name="0_500g" class="form-control" placeholder="Enter Section Name" @if(!empty($shippingchargedetails['0_500g'])) value="{{$shippingchargedetails['0_500g']}}" @endif>
                    </div>
                    <span class="text-danger error-text section_name_error"></span>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Rate (501-1000g)</label>
                        <input type="text" name="501_1000g" class="form-control" placeholder="Enter Section Name" @if(!empty($shippingchargedetails['501_1000g'])) value="{{$shippingchargedetails['501_1000g']}}" @endif>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Rate (1001-2000g)</label>
                        <input type="text" name="1001_2000g" class="form-control" placeholder="Enter Section Name" @if(!empty($shippingchargedetails['1001_2000g'])) value="{{$shippingchargedetails['1001_2000g']}}" @endif>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Rate (2001-5000g)</label>
                        <input type="text" name="2001_5000g" class="form-control" placeholder="Enter Section Name" @if(!empty($shippingchargedetails['2001_5000g'])) value="{{$shippingchargedetails['2001_5000g']}}" @endif>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Rate (above-5000g)</label>
                        <input type="text" name="above_5000g" class="form-control" placeholder="Enter Section Name" @if(!empty($shippingchargedetails['above_5000g'])) value="{{$shippingchargedetails['above_5000g']}}"  @endif>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1" {{$shippingchargedetails['status'] == '1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="exampleCheck1">Status</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">Update</button>

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection