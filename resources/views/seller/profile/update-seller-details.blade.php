@extends('layouts.seller')

@section('content')
 <!-- general form elements -->
 <div class="card card-primary">
     <div class="card-header">
         <h3 class="card-title">Change Admin Details</h3>
     </div>
     <!-- /.card-header -->
     <!-- form start -->
     <form action=" {{route('seller.update-details')}} " enctype=" multipart/form-data" method="post">

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
                 <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$sellerdetail['email']}}">
             </div>

             <div class="form-group">
                 <label for="exampleInputEmail1">Phone</label>
                 <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value="{{$sellerdetail['phone']}}" >
             </div>
             <div class="form-group">
                 <label for="exampleInputPassword1">Name</label>
                 <input type="text" name="name" class="form-control" value="{{$sellerdetail['name']}}" >
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