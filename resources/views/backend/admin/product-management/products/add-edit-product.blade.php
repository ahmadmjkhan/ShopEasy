@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Product
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>{{$title}}</b>

                    <a href="{{route('admin.product_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form @if(empty($products->id)) action="{{url('admin/add-edit-products')}}" @else action="{{url('admin/add-edit-products',$products->id)}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">

                @csrf
                <div class="card-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row mb-4">



                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control categoryfilter">
                                    <option value="">Select</option>
                                    @foreach($categories as $section)
                                    <optgroup label="{{$section->section_name}}"></optgroup>

                                    @foreach($section->categories as $category)
                                    <option @if(!empty($products->category_id == $category->id)) selected="" @endif value="{{$category->id}}">&nbsp;&nbsp;&nbsp;--&nbsp; {{$category->category_name}}</option>

                                    @foreach($category->subcategories as $subcategory)
                                    <option @if(!empty($products->category_id == $subcategory->id)) selected="" @endif value="{{$subcategory->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp; {{$subcategory->category_name}}</option>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </select>
                                <span class="text-danger error-text section_id_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="loadFilters">
                                    @include('backend.admin.catalogue-management.filters.category-filter')
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">



                                <label for="">Select Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($brands as $brand)

                                    <option value="{{$brand->id}}" @if(!empty($products->brand_id == $brand->id)) selected="" @endif>{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text section_id_error"></span>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Product Name</label>
                                <input type="text" id="form6Example1" name="product_name" class="form-control" placeholder="Product Name" @if(!empty($products->product_name)) value="{{$products->product_name}}" @else value="{{old('product_name')}}" @endif />
                                <span class="text-danger error-text product_name_error"></span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Product Code</label>
                                <input type="text" id="form6Example1" name="product_code" class="form-control" placeholder="Product Code" @if(!empty($products->product_code)) value="{{$products->product_code}}" @else value="{{old('product_code')}}" @endif />
                                <span class="text-danger error-text product_code_error"></span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Product Color</label>
                                <input type="text" id="form6Example1" name="product_color" class="form-control" placeholder="Product Code" @if(!empty($products->product_color)) value="{{$products->product_color}}" @else value="{{old('product_color')}}" @endif />
                                <span class="text-danger error-text product_color_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Product Price</label>
                                <input type="text" id="form6Example1" name="product_price" class="form-control" placeholder="Product Price" @if(!empty($products->product_price)) value="{{$products->product_price}}" @else value="{{old('product_price')}}" @endif />
                                <span class="text-danger error-text product_price_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Product Discount(%)</label>

                                <input type="text" id="form6Example1" name="product_discount" class="form-control" placeholder="Product Discount" @if(!empty($products->product_discount)) value="{{$products->product_discount}}" @else value="{{old('product_discount')}}" @endif />
                                <span class="text-danger error-text product_discount_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Product Weight</label>
                                <input type="text" id="form6Example1" name="product_weight" class="form-control" placeholder="Product Weight" @if(!empty($products->product_weight)) value="{{$products->product_weight}}" @else value="{{old('product_weight')}}" @endif />
                                <span class="text-danger error-text product_weight_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Product GST(%)</label>

                                <input type="text" id="form6Example1" name="product_gst" class="form-control" placeholder="Product GST" @if(!empty($products->product_gst)) value="{{$products->product_gst}}" @else value="{{old('product_gst')}}" @endif />
                                <span class="text-danger error-text product_gst_error"></span>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Meta Title</label>
                                <input type="text" id="form6Example1" name="meta_title" class="form-control" @if(!empty($products->meta_title)) value="{{$products->meta_title}}" @else value="{{old('meta_title')}}" @endif />
                                <span class="text-danger error-text meta_title_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Long Description</label>
                                <textarea name="long_description" class="form-control" cols="30" rows="10">{{$products->long_description}}</textarea>
                                <span class="text-danger error-text long_description_error"></span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">


                                <label for="">Short Description</label>
                                <textarea name="short_description" class="form-control" cols="30" rows="10">{{$products->short_description}}</textarea>
                                <span class="text-danger error-text short_description_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Meta Description</label>
                                <input type="text" id="form6Example1" name="meta_description" class="form-control" @if(!empty($products->meta_description)) value="{{$products->meta_description}}" @else value="{{old('meta_description')}}" @endif />
                                <span class="text-danger error-text meta_description_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Meta Keywords</label>
                                <input type="text" id="form6Example1" name="meta_keywords" class="form-control" @if(!empty($products->meta_keywords)) value="{{$products->meta_keywords}}" @else value="{{old('meta_keywords')}}" @endif />
                                <span class="text-danger error-text meta_keywords_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Product Image</label>
                                <input type="file" id="form6Example1" name="product_image" class="form-control" @if(!empty($products->product_image)) value="{{$products->product_weight}}" @else value="{{old('product_weight')}}" @endif />

                                <img src="{{url('uploads/images/products/small/',$products->product_image)}}" alt="">
                                <span class="text-danger error-text product_image_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Product Video</label>
                                <input type="file" id="form6Example1" name="product_video" class="form-control" @if(!empty($products->product_video)) value="{{$products->product_video}}" @else value="{{old('product_video')}}" @endif />
                                <span class="text-danger error-text product_image_error"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="">Feature Product</label>
                                <input type="checkbox" id="form6Example1" name="is_feature" @if(!empty($products->is_feature) && $products->is_feature == 'Yes')) checked="" @endif />

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="">Best Seller Product</label>
                                <input type="checkbox" id="form6Example1" name="is_bestseller" @if(!empty($products->is_bestseller) && $products->is_bestseller == 'Yes')) checked="" @endif />

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="">Status</label>
                                <input type="checkbox" id="form6Example1" name="status" value="1" @if(!empty($products->status) && $products->status == '1') checked="" @endif />

                            </div>
                        </div>


                    </div>


                </div>

                <div class="card-footer">
                    @if(empty($products->id))
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">ADD PRODUCT</button>
                    @else
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">UPDATE PRODUCT</button>
                    @endif

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection