@extends('layouts.admin')

@section('content')
 <!-- general form elements -->
 <div class="card card-primary">
     <div class="card-header">
         <h3 class="card-title">Change Admin Details</h3>
     </div>
     <!-- /.card-header -->
     <!-- form start -->
     <form action=" {{route('admin.update-details')}} " enctype=" multipart/form-data" method="post">

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
                 <label for="exampleInputEmail1">Email address</label>
                 <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$admindetail['email']}}">
             </div>

             <div class="form-group">
                 <label for="exampleInputEmail1">Type</label>
                 <input type="email" class="form-control" id="exampleInputEmail1" value="{{$admindetail['type']}}" readonly>
             </div>
             <div class="form-group">
                 <label for="exampleInputPassword1">Name</label>
                 <input type="text" name="name" class="form-control" value="{{$admindetail['name']}}" >
                 <span id="check_password"></span>
             </div>

              

             

         </div>
         <!-- /.card-body -->

         <div class="card-footer">
             <button type="submit" class="btn btn-primary">Submit</button>
         </div>
     </form>
 </div>
 <!-- /.card -->

 @endsection