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
                   
                    <a href="{{route('admin.brand_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form @if(empty($brand->id)) action="{{url('admin/add-edit-brands')}}" @else action="{{url('admin/add-edit-brands',$brand->id)}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" placeholder="Enter Brand Name" @if(!empty($brand->brand_name)) value="{{$brand->brand_name}}" @else value="{{old('brand_name')}}" @endif>
                    </div>
                    <span class="text-danger error-text brand_name_error"></span>

                    <div class="form-group">
                        <label for="exampleInputFile">Brand Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="brand_image" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1" {{$brand->status == '1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="exampleCheck1">Status</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="popular" class="form-check-input" id="exampleCheck1" {{$brand->popular == '1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="exampleCheck1">Popular</label>
                    </div>
                </div>




                
                <!-- /.card-body -->

                <div class="card-footer">
                    @if(empty($brand->id))
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @else
                    <button type="submit" class="btn btn-primary">Update</button>
                    @endif
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection