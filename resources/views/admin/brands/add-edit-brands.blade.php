@extends('layouts.admin')

@section('title')
Add Category
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header">
        
        <h4 class="text-center ">{{$title}}</h4>
    </div>
   

    <form  @if(empty($brand->id))  action="{{url('admin/add-edit-brand')}}" @else action="{{url('admin/add-edit-brand',$brand->id)}}" @endif  method="POST" class="form_operation" enctype="multipart/form-data">

        @csrf
        <div class="card-body">
        <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">

                        <input type="text" id="form6Example1" name="brand_name" class="form-control" placeholder="Brand Name" @if(!empty($brand->brand_name)) value="{{$brand->brand_name}}" @else value="{{old('brand_name')}}" @endif />
                        <span class="text-danger error-text brand_name_error"></span>
                    </div>
                </div>
            


                <div class="col-md-6">
                    <div class="mb-3 form-check">
                    
                        <input type="checkbox" class="form-check-input" value="1" name="status" {{$brand->status == '1' ? 'checked' : ''}} >
                        <label class="form-check-label" for="exampleCheck1">Status</label>
                       
                    </div>
                </div>

                <div class="col-md-6">
                <div class="mb-3 form-check">
                    
                    <input type="checkbox" class="form-check-input" value="1" name="popular" {{$brand->popular == '1' ? 'checked' : ''}} >
                    <label class="form-check-label" for="exampleCheck1">Popular</label>
                   
                </div>

                </div>

                <div class="col-md-12 mt-2">
                    <div class="form-group">
                      @if(!empty($brand->brand_image))
                      <input type="file" id="form6Example2" name="brand_image" class="form-control-file" />
                      <img src="{{url('uploads/images/brands',$brand->brand_image)}}" alt="" width="100">
                      @else
                      <input type="file" id="form6Example2" name="brand_image" class="form-control-file" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Add Brand</button>
        </div>
    </form>
</div>








@endsection