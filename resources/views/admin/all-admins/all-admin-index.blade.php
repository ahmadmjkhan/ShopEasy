@extends('layouts.admin')

@section('title')
All Category
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="float-start">{{$title}}
        
                    
                        <a href="{{route('admin.add_edit_all_admin_details')}}" class="float-right btn btn-primary">ADD ADMIN</a>
                    
                
        </h4>
    </div>

    <div class="card-body page-reload">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Admin ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>

                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>


                @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->id}}</td>
                    <td>1</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->type}}</td>
                    <td>{{$admin->mobile}}</td>
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

                        <a href="{{url('admin/add_edit_all_admin_details',$admin->id)}}" title="Edit Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-copy"></i></a>

                        <a href="{{url('admin/add-edit-banners',$admin->id)}}" title="View Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>



                        <form action="{{route('admin.delete_admins',$admin->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>

                    </td>


                </tr>
                @endforeach

                </tfoot>
        </table>
    </div>



    @endsection