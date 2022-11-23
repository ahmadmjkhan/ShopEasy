@extends('layouts.admin')

@section('title')
All Category
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="float-start">
        
                    
                        
                
        </h4>
    </div>

    <div class="card-body page-reload">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    

                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>


                @foreach($allusers as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>1</td>
                    <td>{{$user->name}}</td>
                    
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>


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

                        <a href="{{url('admin/add_edit_all_seller_details',$user->id)}}" title="Edit Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-copy"></i></a>

                        <a href="{{url('admin/add-edit-banners',$user->id)}}" title="View Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>



                        <form action="{{route('admin.delete_admins',$user->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>

                    </td>


                </tr>
                @endforeach

                </tfoot>
        </table>
    </div>



    @endsection