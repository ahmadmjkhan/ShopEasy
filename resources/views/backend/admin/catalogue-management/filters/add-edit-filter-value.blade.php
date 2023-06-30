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

                    <a href="{{route('admin.filter_values_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form @if(empty($filtersvalue->id)) action="{{url('admin/add-edit-filter-values')}}" @else action="{{url('admin/add-edit-filter-values',$filtersvalue->id)}}" @endif method="POST" class="form_operation">

                @csrf
                <div class="card-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row mb-4">



                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Select Filter</label>
                                <select name="filter_id" id="filter_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($filters as $filter)
                                    <option value="{{$filter->id}}" @if(!empty($filtersvalue->id) && $filtersvalue->filter_id == $filter->id) selected="" @endif >{{$filter->filter_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text section_id_error"></span>
                            </div>
                        </div>





                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Filter Value</label>
                                <input type="text" id="form6Example1" name="filter_value" class="form-control" placeholder="Product Code" @if(!empty($filtersvalue->filter_value)) value="{{$filtersvalue->filter_value}}" @else value="{{old('filter_value')}}" @endif />
                                <span class="text-danger error-text product_code_error"></span>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="">Status</label>
                                <input type="checkbox" id="form6Example1" name="status" value="1" {{$filtersvalue->status == '1' ? 'checked' : ''}}>

                            </div>
                        </div>


                    </div>










                </div>

                <div class="card-footer">
                    @if(empty($filtersvalue->id))
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Add Filter Value</button>
                    @else
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Update Filter Value</button>
                    @endif

                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection