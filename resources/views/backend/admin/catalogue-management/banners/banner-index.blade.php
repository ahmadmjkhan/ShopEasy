@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Banner
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL BANNERS</b>


                    <a href="{{route('admin.bulk-delete-banners')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>

                    <a href="{{route('admin.banner_store')}}" class="btn bg-gradient-danger btn-sm float-right">Add Banner</a>
                </h5>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped page-reload checkbox-datatable">
                    <thead class="table-danger">
                        <tr>
                            <th>

                                <input type="checkbox" class="master">

                            </th>

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
                            <td>
                                <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$banner->id}}">
                            </td>
                            <td>{{$banner->id}}</td>
                            <td>{{$banner->type}}</td>
                            <td><img src="{{asset('uploads/catalogue-images/banners/'.$banner->banner_image)}}" width="80" height="80" alt=""></td>
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
                            <td><a href="{{url('admin/add-edit-banners',$banner->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>



                                <form action="{{route('admin.delete_banner',$banner->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>


                            </td>

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



@section('script')

<script>

</script>


@endsection


@endsection