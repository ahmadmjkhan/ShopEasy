@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="float-start">ALL SECTIONS
            <a href="{{route('admin.brand_store')}}" class="float-right btn btn-info">ADD BRANDS</a>
        </h4>
    </div>
    <!-- /.card-header -->
    <div class="card-body page-reload">
        <table id="example1" class="table stripe data-table-export nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand Name</th>
                    <th>Brand Image</th>
                    <th>Status</th>
                    <th>Popular</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($allbrands as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->brand_name}}</td>
                    <td><img src="{{url('uploads/images/brands/',$brand->brand_image)}}" width="100" alt="no image"></td>

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
                    <td><a href="{{url('admin/add-edit-brand',$brand->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-filled"></i></a>

                        <form action="{{route('admin.delete_brand',$brand->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>
                    </td>
                    </td>
                    @endforeach




            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Brand Name</th>
                    <th>Brand Image</th>
                    <th>Status</th>
                    <th>Popular</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
</div>
@endsection