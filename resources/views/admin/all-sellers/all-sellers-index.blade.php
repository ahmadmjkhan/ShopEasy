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
                    <th>Seller ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    

                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>


                @foreach($allsellers as $seller)
                <tr>
                    <td>{{$seller->id}}</td>
                    <td>1</td>
                    <td>{{$seller->name}}</td>
                    
                    <td>{{$seller->phone}}</td>
                    <td>{{$seller->email}}</td>


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

                        <a href="{{url('seller/add_edit_all_seller_details',$seller->id)}}" title="Edit Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-copy"></i></a>

                        <a href="{{url('admin/add-edit-banners',$seller->id)}}" title="View Admin" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>



                        <form action="{{route('admin.delete_admins',$seller->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>

                    </td>


                </tr>
                @endforeach

                </tfoot>
        </table>
    </div>



    @endsection