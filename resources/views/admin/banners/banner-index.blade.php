@extends('layouts.admin')

@section('content')








<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>DataTable</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                DataTable
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <h4>
                        <a href="{{route('admin.banner_store')}}" class="float-right btn btn-primary">ADD BANNER</a>
                    </h4>
                </div>
            </div>
        </div>


        <!-- Export Datatable start -->
        <div class="card-box mb-30 page-reload">
            <div class="pd-20">

            </div>
            <div class="pb-20">
                <table class="table stripe data-table-export nowrap">

                    <thead>
                        <tr>

                            <th class="table-plus datatable-nosort">ID</th>
                            <th>Type</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Title</th>
                            <th>Alt</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_banners as $banner)
                        <tr>
                            <td>{{$banner->id}}</td>
                            <td>{{$banner->type}}</td>
                            <td><img src="{{asset('uploads/images/banners/'.$banner->banner_image)}}" width="80" height="80" alt=""></td>
                            <td>{{$banner->link}}</td>
                            <td>{{$banner->title}}</td>
                            <td>{{$banner->alt}}</td>


                            <!--- Status Active/Inactive --->
                            <td>

                                @if($banner->status == '1')
                                <a href="javascript:void(0)" class="updatebannerstatus text-primary " id="banner-{{$banner->id}}" banner_id="{{$banner->id}}">
                                   
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updatebannerstatus text-primary" id="banner-{{$banner->id}}" banner_id="{{$banner->id}}">
                                <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif

                            </td>

                            <!--- Status in Active closed --->
                            <td><a href="{{url('admin/add-edit-banners',$banner->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-filled"></i></a>

                            <!-- <a href="{{route('admin.delete_banner',$banner->id)}}" title="Delete Section" class="float-center mx-1 btn-sm btn btn-danger delete_form_operation"><i class="icon-copy fi-trash"></i></a><form action="{{route('admin.delete_banner',$banner->id)}}" class="delete_form_operation" method="post">@csrf</form> -->

                            <form action="{{route('admin.delete_banner',$banner->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                               <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button> 
                            </form>
                                
                               
                            </td>
                            </td>
                            @endforeach




                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Datatable End -->
    </div>

</div>

@endsection