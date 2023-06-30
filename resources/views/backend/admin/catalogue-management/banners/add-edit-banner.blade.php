@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Banner
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>{{$title}}</b>

                    <a href="{{route('admin.banner_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form @if(empty($banners->id)) action="{{url('admin/add-edit-banners')}}" @else action="{{url('admin/add-edit-banners',$banners->id)}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row mb-4">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Select Banner Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select Type</option>

                                    <option value="Slider" @if(!empty($banners->type) && $banners->type == "Slider") selected="" @endif >Slider</option>
                                    <option value="Fix" @if(!empty($banners->type) && $banners->type == "Fix") selected="" @endif >Fix</option>

                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Banner Link</label>
                                <input type="text" id="form6Example1" name="link" class="form-control" placeholder="Link" @if(!empty($banners->link)) value="{{$banners->link}}" @else value="{{old('link')}}" @endif />
                                <span class="text-danger error-text link_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Banner Title</label>
                                <input type="text" id="form6Example1" name="title" class="form-control" placeholder="Title" @if(!empty($banners->title)) value="{{$banners->title}}" @else value="{{old('title')}}" @endif />
                                <span class="text-danger error-text title_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Alternate</label>
                                <input type="text" id="form6Example1" name="alt" class="form-control" placeholder="Alt" @if(!empty($banners->alt)) value="{{$banners->alt}}" @else value="{{old('alt')}}" @endif />
                                <span class="text-danger error-text alt_error"></span>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="mb-3 form-check">

                                <input type="checkbox" class="form-check-input" value="1" name="status" {{$banners->status == '1' ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck1">Status</label>

                            </div>
                        </div>



                        <div class="col-md-12 mt-2">
                            <div class="form-group">

                                <input type="file" id="form6Example2" name="banner_image" class="form-control-file" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer mb-3">
                    <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Add Section</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection