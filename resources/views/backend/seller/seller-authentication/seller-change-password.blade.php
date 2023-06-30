@extends('backend.seller.layouts.seller-master-layout')

@section('content')
 <!-- general form elements -->
 <div class="card card-primary">
     <div class="card-header">
         <h3 class="card-title">Update Password</h3>
     </div>
     <!-- /.card-header -->
     <!-- form start -->
     <form action="{{route('seller.change-password')}}" method="post" class="change_password_form_operation">

         @csrf

         <!-- @if(Session::has('error_message'))

         <span class="alert alert-danger ">
             {{Session::get('error_message')}}
         </span>
         @endif

         @if(Session::has('success_message'))

         <span class="alert alert-success ">
             {{Session::get('success_message')}}
         </span>
         @endif -->

         <div class="success_message alert alert-success" style="display:none"></div>
            <div class="error_message alert alert-danger" style="display:none" ></div>
         <div class="card-body">
             <div class="form-group">
                 <label for="exampleInputEmail1">Email address</label>
                 <input type="email" class="form-control" id="exampleInputEmail1" value="{{Auth::guard('seller')->user()->email}}" readonly>
             </div>

             
             <div class="form-group">
                 <label for="exampleInputPassword1">Current Password</label>
                 <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Password">
                 <span class="text-danger current-password" style="display:none ;"></span>
             </div>

             <div class="form-group">
                 <label for="exampleInputPassword1">New Password</label>
                 <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password">
             </div>

             <div class="form-group">
                 <label for="exampleInputPassword1">Confirm Password</label>
                 <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Password">
                 <span class="text-danger con-pass" style="display:none;"></span>
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


 @section('script')
 
 @endsection


 