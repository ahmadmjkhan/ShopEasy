@extends('backend.admin.layouts.admin-master-layout')

@section('content')

<!-- Content Wrapper. Contains page content -->



<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{asset('uploads/seller/seller_avatar/'.$sellerPersonalDetails->seller_image)}}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$sellerPersonalDetails->name}}</h3>

                        <p class="text-muted text-center"></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#personaldetails" data-toggle="tab">Personal Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bankdetails" data-toggle="tab">Bank Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bussinessdetails" data-toggle="tab">Bussiness Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#comissiondetails" data-toggle="tab">Comissions</a></li>
                            
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personaldetails">
                                <form class="form-horizontal">

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Name:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            {{$sellerPersonalDetails->name}}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Email:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            {{$sellerPersonalDetails->email}}

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Address:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            <b>Street:</b>{{$sellerPersonalDetails->address}}<br>
                                            <b>City:</b>{{$sellerPersonalDetails->city}}<br>
                                            <b>State:</b>{{$sellerPersonalDetails->state}}<br>
                                            <b>Pincode:</b>{{$sellerPersonalDetails->pincode}}<br>
                                            <b>Country:</b>{{$sellerPersonalDetails->country}}<br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Mobile:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            {{$sellerPersonalDetails->phone}}

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <!-- <button type="submit" class="btn btn-danger">Submit</button> -->
                                            <a href="#bankdetails" data-toggle="tab" class="btn btn-danger">Next</a>
                                        </div>
                                    </div>
                                </form>




                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="bankdetails">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Account Type:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            {{$sellerBankDetails->account_type}}

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Bank Name:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            {{$sellerBankDetails->bank_name}}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Account Number:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            {{$sellerBankDetails->account_number}}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <b>Bank IFSC code:</b>
                                        </div>

                                        <div class="col-sm-10">


                                            {{$sellerBankDetails->bank_ifsc_code }}

                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <!-- <button type="submit" class="btn btn-danger">Submit</button> -->
                                            <a href="#bussinessdetails" data-toggle="tab" class="btn btn-danger">Next</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="bussinessdetails">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Shop Name:</b>
                                        </div>

                                        <div class="col-sm-6">


                                            {{$sellerBussinessDetails->shop_name}}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Shop Email:</b>
                                        </div>

                                        <div class="col-sm-6">


                                            {{$sellerBussinessDetails->shop_email}}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Mobile:</b>
                                        </div>

                                        <div class="col-sm-6">


                                            {{$sellerBussinessDetails->shop_mobile}}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Shop Address:</b>
                                        </div>

                                        <div class="col-sm-6">


                                            <b>Street:</b>{{$sellerBussinessDetails->shop_address}}<br>
                                            <b>City:</b>{{$sellerBussinessDetails->shop_city}}<br>
                                            <b>State:</b>{{$sellerBussinessDetails->shop_state}}<br>
                                            <b>Pincode:</b>{{$sellerBussinessDetails->shop_pincode}}<br>
                                            <b>Country:</b>{{$sellerBussinessDetails->shop_country}}<br>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Address Proof:</b>
                                        </div>

                                        <div class="col-sm-6">

                                            {{$sellerBussinessDetails->address_proof}}


                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Address Proof Image:</b>
                                        </div>

                                        <div class="col-sm-6">

                                            <a href="" data-toggle="modal" data-target="#addressproofmodal"><img class="profile-user-img img-fluid img-circle" src="{{asset('uploads/seller/address_proof_image/'.$sellerBussinessDetails->address_proof_image)}}" alt="User profile picture"></a>


                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>Bussiness License Number:</b>
                                        </div>

                                        <div class="col-sm-6">

                                            {{$sellerBussinessDetails->bussiness_license_number}}


                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>GST Number:</b>
                                        </div>

                                        <div class="col-sm-6">

                                            {{$sellerBussinessDetails->gst_number}}


                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <b>PAN Number:</b>
                                        </div>

                                        <div class="col-sm-6">

                                            {{$sellerBussinessDetails->pan_number}}


                                        </div>
                                    </div>


                                </form>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        @if($sellerPersonalDetails->status == '0')
                                        <form action="{{route('admin.approve_seller',$sellerPersonalDetails->id)}}" class="approve_form_operation " style="display:inline;" method="post">@csrf
                                            <button class="btn btn btn-danger approve"><i class="fas fa-trash"></i> Approve Seller</button>
                                        </form>
                                        <button class="btn btn btn-success approved" style="display:none"><i class="fas fa-trash"></i> Approved</button>
                                        @else

                                        <button class="btn btn btn-success"><i class="fas fa-trash"></i> Approved</button>

                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="active tab-pane" id="comissiondetails">

                            @if(Session::has('success_message'))

                       <div class="alert alert-success">
                           {{Session::get('success_message')}}
                       </div>
                       @endif


                                <form class="form-horizontal" action="{{route('admin.seller-comissions')}}" method="post">
                                     @csrf


                                     <h5 class="text-center">COMISSIONS INFORMATION</h5>
                                     
                                    <div class="form-group row">
                                       
                                        <div class="col-md-4">
                                            <b>Comission Per Order Item(%):</b>
                                        </div>

                                        <div class="col-sm-8">

                                            <input type="hidden" name="seller_id" value="{{$sellerPersonalDetails->id}}">
                                            <input type="text" name="comissions" @if(isset($sellerPersonalDetails->comissions)) value="{{$sellerPersonalDetails->comissions}}" @endif>

                                        </div>
                                    </div>
                                   
                                    <input type="submit" value="Update" class="btn btn-sm btn-info"></>
                                </form>




                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>



<div class="modal fade" id="addressproofmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Address Proof Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="profile-user-img img-fluid w-100" src="{{asset('uploads/seller/address_proof_image/'.$sellerBussinessDetails->address_proof_image)}}" alt="User profile picture"></a>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.content -->

<!-- Spinner Area -->

<div id="spinner-container" class="div-container" style="display:none;">
    <svg viewBox="0 0 100 100">
        <defs>
            <filter id="shadow">
                <feDropShadow dx="0" dy="0" stdDeviation="1.5" flood-color="#fc6767" />
            </filter>
        </defs>
        <circle id="spinner" style="fill:transparent;stroke:#dd2476;stroke-width: 7px;stroke-linecap: round;filter:url(#shadow);" cx="50" cy="50" r="45" />
    </svg>
</div>


<!-- spinner Area end -->


@endsection