@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Users
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title"><b>All Users</b></h3>
                        <a href="{{route('admin.bulk-delete-users')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped page-reload">
                            <thead>
                                <tr>
                                    <th>

                                        <input type="checkbox" class="master">

                                    </th>
                                    <th>Avatar</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($all_users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$user->id}}">
                                    </td>
                                    <td><img src="{{asset('uploads/user_avatar/'.$user->user_avatar)}}" alt="" width="50%"></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>

                                    <!-- <td>

                                        <input data-id="{{$user->id}}" class="toggle-class updatesellerstatus" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>

                                    </td> -->
                                    <td>

                                        <!--- Status Active/Inactive --->
                                        @if($user->status == '1')
                                        <a href="javascript:void(0)" class="updateuserstatus" id="user-{{$user->id}}" user_id="{{$user->id}}">
                                            <i class='icon-copy fa fa-toggle-on fa-lg' status='Active'></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updateuserstatus" id="user-{{$user->id}}" user_id="{{$user->id}}">
                                            <i class='icon-copy fa fa-toggle-off fa-lg' status='InActive'></i>
                                        </a>
                                        @endif
                                        <!--- Status in Active closed --->

                                    </td>
                                    <td>
                                        <a href=""><i class="fas fa-edit"></i></a>
                                        <!-- <a href="{{route('admin.delete_seller',$user->id)}}" class="delete_form_operation"><i class="fas fa-trash"></i></a> -->
                                        <form action="{{route('admin.delete_user',$user->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
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