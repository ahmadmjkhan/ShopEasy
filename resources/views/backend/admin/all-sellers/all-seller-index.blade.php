@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Sellers
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Sellers</h3>
                        <a href="{{route('admin.bulk-delete-sellers')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped page-reload">
                            <thead>
                                <tr>
                                    <th>

                                        <input type="checkbox" class="master">

                                    </th>
                                    <th width="20%">Avatar</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Confirm</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($all_sellers as $seller)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$seller->id}}">
                                    </td>
                                    <td><img src="{{asset('uploads/seller/seller_avatar/'.$seller->seller_image)}}" alt="" width="25%"></td>
                                    <td>{{$seller->name}}</td>
                                    <td>{{$seller->email}}</td>
                                    <td>{{$seller->phone}}</td>
                                    <td>{{$seller->confirm}}</td>
                                    <!-- <td>

                                        <input data-id="{{$seller->id}}" class="toggle-class updatesellerstatus" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $seller->status ? 'checked' : '' }}>

                                    </td> -->
                                    <td>

                                        <!--- Status Active/Inactive --->
                                        @if($seller->status == '1')
                                        <a href="javascript:void(0)" class="updatesellerstatus" id="seller-{{$seller->id}}" seller_id="{{$seller->id}}">
                                            <i class='icon-copy fa fa-toggle-on fa-lg' status='Active'></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updatesellerstatus" id="seller-{{$seller->id}}" seller_id="{{$seller->id}}">
                                            <i class='icon-copy fa fa-toggle-off fa-lg' status='InActive'></i>
                                        </a>
                                        @endif
                                        <!--- Status in Active closed --->

                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{route('admin.view_seller_details',$seller->id)}}"><i class="fas fa-eye"></i></a>
                                        <!-- <a href="{{route('admin.delete_seller',$seller->id)}}" class="delete_form_operation"><i class="fas fa-trash"></i></a> -->
                                        <form action="{{route('admin.delete_seller',$seller->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>


                                @endforeach



                            </tbody>
                            
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection