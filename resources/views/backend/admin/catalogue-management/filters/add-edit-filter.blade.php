@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Filter
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>{{$title}}</b>

                    <a href="{{route('admin.filter_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form @if(empty($filters->id)) action="{{url('admin/add-edit-filter')}}" @else action="{{url('admin/add-edit-filter',$filters->id)}}" @endif method="POST" class="form_operation">

                @csrf
                <div class="card-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row mb-4">



                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Select Category</label>
                                <select name="cat_ids[]" id="cat_ids" class="form-control" multiple="">
                                    <option value="">Select</option>
                                    @foreach($categories as $section)
                                    <optgroup label="{{$section->section_name}}"></optgroup>

                                    @foreach($section->categories as $category)
                                    <option @if(!empty($filters->category_id == $category->id)) selected="" @endif value="{{$category->id}}">&nbsp;&nbsp;&nbsp;--&nbsp; {{$category->category_name}}</option>

                                    @foreach($category->subcategories as $subcategory)
                                    <option @if(!empty($filters->category_id == $subcategory->id)) selected="" @endif value="{{$subcategory->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp; {{$subcategory->category_name}}</option>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </select>
                                <span class="text-danger error-text section_id_error"></span>
                            </div>
                        </div>





                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Filter Name</label>
                                <input type="text" id="form6Example1" name="filter_name" class="form-control" placeholder="Product Code" @if(!empty($filters->filter_name)) value="{{$filters->filter_name}}" @else value="{{old('filter_name')}}" @endif />
                                <span class="text-danger error-text product_code_error"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Filter Column</label>
                                <input type="text" id="form6Example1" name="filter_column" class="form-control" placeholder="Product Code" @if(!empty($filters->filter_column)) value="{{$filters->filter_column}}" @else value="{{old('filter_column')}}" @endif />
                                <span class="text-danger error-text product_code_error"></span>
                            </div>
                        </div>






                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Status</label>
                                <input type="checkbox" id="form6Example1" name="status" value="1" @if(!empty($filters->status) && $filters->status == '1') checked="" @endif />

                            </div>
                        </div>


                    </div>










                </div>
                <div class="card-footer">
                    @if(empty($filters->id))
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Add Filter Column</button>
                    @else
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Update Filter Column</button>
                    @endif

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection