@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Brands
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL BRANDS</b>


                    <a href="{{route('admin.bulk-delete-brands')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>

                    <a href="{{route('admin.brand_store')}}" class="btn bg-gradient-danger btn-sm float-right">Add Brand</a>
                </h5>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped page-reload checkbox-datatable">
                    <thead class="table-success">

                        <tr>


                            <th>

                                <input type="checkbox" class="master">

                            </th>
                            <th>ID</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Status</th>
                            <th>Popular</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @foreach($all_brands as $brand)
                        <tr>
                            <td>
                                <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$brand->id}}">
                            </td>
                            <td>{{$brand->id}}</td>
                            <td><img src="{{asset('uploads/catalogue-images/brands/'.$brand->brand_image)}}" alt="NO image" style="width: 80px;height: 50px;"></td>
                            <td>{{$brand->brand_name}}</td>

                            <!--- Status Active/Inactive --->
                            <td>

                                @if($brand->status == '1')
                                <a href="javascript:void(0)" class="updatebrandstatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updatebrandstatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif

                            </td>

                            <!--- Status in Active closed --->


                            <!--- Status Active/Inactive --->
                            <td>

                                @if($brand->popular == '1')
                                <a href="javascript:void(0)" class="updatebrandpopular" id="popular-{{$brand->id}}" brand_id="{{$brand->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updatebrandpopular" id="popular-{{$brand->id}}" brand_id="{{$brand->id}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif

                            </td>

                            <!--- Status in Active closed --->


                            <td><a href="{{url('admin/add-edit-brands',$brand->id)}}" title="Edit Brand" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>

                                <form action="{{route('admin.delete_brand',$brand->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
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