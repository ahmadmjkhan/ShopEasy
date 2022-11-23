@extends('layouts.admin')

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form @if(empty($all_admin->id)) action=" {{url('admin/add_edit_all_admin_details')}} " @else action=" {{url('admin/add_edit_all_admin_details',$all_admin->id)}} " @endif enctype=" multipart/form-data" method="post" class="form_operation">

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
            <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" name="name" class="form-control" value="{{$all_admin->name}}">
                <span id="check_password"></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$all_admin->email}}">
            </div>

            <div class="form-group">
                <select name="type" id="" class="form-control">
                    <option value="">Select Type</option>
                    <option value="admin" {{$all_admin->type == 'admin' ? 'selected' : ''}}>Admin</option>
                    <option value="subadmin" {{$all_admin->type == 'subadmin' ? 'selected' : ''}}>SubAdmin</option>

                </select>

                <span class="text-danger error-text email_error"></span>
            </div>

            @if(empty($all_admin->id))
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control">
                <span id="check_password"></span>
            </div>
            @else
            
            @endif





        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<!-- /.card -->

@endsection