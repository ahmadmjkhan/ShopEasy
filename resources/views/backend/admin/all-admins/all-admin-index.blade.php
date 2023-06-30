@extends('layouts.admin-app')

@section('title')
All Admins
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>{{$title}}</b>
                    @if(Auth::guard('admin')->user()->type == 'Admin')
                    <a href="{{route('admin.add_edit_all_admin_details')}}" class="float-right btn btn-primary">ADD SUBADMIN</a>
                    @endif
                </h5>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped page-reload checkbox-datatable">
                    <thead class="table-danger">
                        <tr>
                            <th>Admin ID</th>

                            <th>Name</th>
                            <th>Type</th>


                            <th>Email</th>
                            <th>Status</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach($admins as $admin)
                        <tr>
                            <td>{{$admin->id}}</td>

                            <td>{{$admin->name}}</td>
                            <td>{{$admin->type}}</td>

                            <td>{{$admin->email}}</td>


                            <td>

                                <!--- Status Active/Inactive --->
                                @if($admin->status == '1')
                                <a href="javascript:void(0)" class="updateadminstatus" id="admin-{{$admin->id}}" admin_id="{{$admin->id}}">
                                    <i class='icon-copy fa fa-toggle-on fa-lg' status='Active'></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updateadminstatus" id="admin-{{$admin->id}}" admin_id="{{$admin->id}}">
                                    <i class='icon-copy fa fa-toggle-off fa-lg' status='InActive'></i>
                                </a>
                                @endif
                                <!--- Status in Active closed --->

                            </td>




                            <td>

                                <a href="{{url('admin/add_edit_all_admin_details',$admin->id)}}" title="Edit Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>

                                @if($admin->type == 'SubAdmin')

                                <a href="{{url('admin/add-edit-banners',$admin->id)}}" title="View Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-eye" aria-hidden="true"></i></a>

                                @endif



                                <form action="{{route('admin.delete_admins',$admin->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>

                            </td>


                        </tr>
                        @endforeach

                    <tfoot class="table-danger">
                        <tr>
                            <th>Admin ID</th>

                            <th>Name</th>
                            <th>Type</th>


                            <th>Email</th>
                            <th>Status</th>

                            <th>Actions</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->




@section('script')

<script>

</script>


@endsection


@endsection