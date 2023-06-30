@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Brand
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>{{$title}}</b>

                    <a href="{{route('admin.coupon_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form @if(empty($coupon->id)) action="{{url('admin/add-edit-coupons')}}" @else action="{{url('admin/add-edit-coupons',$coupon->id)}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">

                @csrf
                <div class="card-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row mb-4">

                        <div class="col-md-4">
                            @if(empty($coupon['coupon_code']))
                            <div class="form-group">


                                <label for="">Coupon Option</label></br>

                                <span><input type="radio" class="Automatic-Coupon" name="coupon_option" value="Automatic" checked="">&nbsp;Automatic&nbsp;&nbsp;
                                    <span><input type="radio" class="Manual-Coupon" name="coupon_option" value="Manual">&nbsp;Manual&nbsp;&nbsp;<br></br>

                            </div>
                            <div class="form-group coupon-field" style="display: none;">

                                <input type="text" name="coupon_code" class="form-control" placeholder="Enter Coupon Code">

                            </div>
                            @else
                            <input type="hidden" name="coupon_option" value="{{$coupon['coupon_option']}}">
                            <input type="hidden" name="coupon_code" value="{{$coupon['coupon_code']}}">
                            <div class="form-group">
                                <label for="coupon_code">Coupon Code:</label>
                                <span>{{$coupon['coupon_code']}}</span>
                            </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">


                                <label for="">Coupon Type</label></br>

                                <span><input type="radio" name="coupon_type" value="Multiple Times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Multiple Times" ) checked="" @endif>&nbsp;Multiple Times&nbsp;&nbsp;</span>
                                <span><input type="radio" name="coupon_type" value="Single Times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Single Times" ) checked="" @endif>&nbsp;Single Times&nbsp;&nbsp;<br></span></br>



                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">


                                <label for="">Amount Type</label></br>

                                <span><input type="radio" id="Automatic-Coupon" name="amount_type" value="Percentage" @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Percentage" ) checked="" @endif>&nbsp;Percentage&nbsp;(in %)&nbsp;</span>
                                <span><input type="radio" id="Manual-Coupon" name="amount_type" value="Fixed" @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Fixed" ) checked="" @endif>&nbsp;Fixed&nbsp;(INR)<br></span></br>




                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Amount</label>
                                <input type="text" id="form6Example1" name="amount" class="form-control" @if(isset($coupon['amount'])) value="{{$coupon['amount']}}" @else value="{{old('amount')}}" @endif placeholder="Enter Amount" />
                                <span class="text-danger error-text product_name_error"></span>
                            </div>
                        </div>




                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Select Categories</label>
                                <select name="categories[]" id="categories" class="form-control" multiple="">

                                    @foreach($categories as $section)
                                    <optgroup label="{{$section->section_name}}"></optgroup>

                                    @foreach($section->categories as $category)
                                    <option value="{{$category->id}}" @if(in_array($category['id'],$selcats)) selected="" @endif>&nbsp;&nbsp;&nbsp;--&nbsp; {{$category->category_name}}</option>

                                    @foreach($category->subcategories as $subcategory)
                                    <option value="{{$subcategory->id}}" @if(in_array($subcategory['id'],$selcats)) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp; {{$subcategory->category_name}}</option>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </select>
                                <span class="text-danger error-text categories_error"></span>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">


                                <label for="">Select Brands</label>

                                <select name="brands[]" class="form-control" multiple="">

                                    @foreach($brands as $brand)

                                    <option value="{{$brand->id}}" @if(in_array($brand['id'],$selbrands)) selected="" @endif>{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text brands_error"></span>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">


                                <label for="">Select User</label>

                                <select name="users[]" class="form-control" multiple="">

                                    @foreach($users as $user)

                                    <option value="{{$user->email}}" @if(in_array($user['email'],$selusers)) selected="" @endif>{{$user->email}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text users_error"></span>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Expiry Date</label>
                                <input type="date" id="form6Example1" name="expiry_date" id="expiry_date" class="form-control" @if(isset($coupon['expiry_date'])) value="{{$coupon['expiry_date']}}" @else value="{{old('expiry_date')}}" @endif placeholder="Enter Expiry Date" />
                                <span class="text-danger error-text product_name_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Status</label>
                                <input type="checkbox" id="form6Example1" name="status" value="1" @if(!empty($coupon->status) && $coupon->status == '1') checked="" @endif />

                            </div>
                        </div>





                    </div>
                </div>


                <div class="card-footer">
                    @if(empty($coupon->id))
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Add Coupon</button>
                    @else
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Update Coupon</button>
                    @endif

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection