@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Section
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>{{$title}}</b><a href="{{route('admin.section_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form @if(empty($section->id)) action="{{url('admin/add-edit-sections')}}" @else action="{{url('admin/add-edit-sections',$section->id)}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Section Name</label>
                        <input type="text" name="section_name" class="form-control" placeholder="Enter Section Name" @if(!empty($section->section_name)) value="{{$section->section_name}}" @else value="{{old('section_name')}}" @endif>
                    </div>
                    <span class="text-danger error-text section_name_error"></span>

                    <div class="form-group">
                        <label for="exampleInputFile">Section Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="section_image" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="status" class="form-check-input" id="exampleCheck1" {{$section->status == '1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="exampleCheck1">Status</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    @if(empty($section->id))
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