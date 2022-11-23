@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="float-start">ALL PRODUCTS
            <a href="{{route('admin.product_store')}}" class="float-right btn btn-info">ADD PRODUCTS</a>
        </h4>
    </div>
    <!-- /.card-header -->
    <div class="card-body page-reload">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Added By</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td><img src="{{url('uploads/images/products/small/'.$product->product_image)}}" alt="" width="100"></td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->product_code}}</td>
                    <td>{{$product->product_color}}</td>
                    <td>{{$product->categories->category_name}}</td>
                    <td>{{$product->section->section_name}}</td>
                    <td>
                        @if($product->admin_type == 'vendor')
                        <a href="{{route('view.vendor',$product->admin_id)}}">{{ucfirst($product->admin_type)}}</a>
                        @else
                        {{$product->admin_type}}
                        @endif

                    </td>
                    <!--- Status Active/Inactive --->
                    <td>

                        @if($product->status == '1')
                        <a href="javascript:void(0)" class="updateproductstatus" id="products-{{$product->id}}" product_id="{{$product->id}}">
                        <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" class="updateproductstatus" id="products-{{$product->id}}" product_id="{{$product->id}}">
                        <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="Active"></i>
                        </a>
                        @endif

                    </td>

                    <!--- Status in Active closed --->

                    <td>
                        <a href="{{route('admin.product_store',$product->id)}}" title="Edit Category" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-filled"></i></a>

                        <a href="{{route('admin.add_edit_attributes',$product->id)}}" title="Add Attributes" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy bi bi-plus-square-fill"></i></a>

                        <a href="{{route('admin.add_multiple_images',$product->id)}}" title="Add Multiple Images" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy ion-ios-photos"></i></a>


                        <form action="{{route('admin.delete_product',$product->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>
                    </td>


                    @endforeach




            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Added By</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
</div>
@endsection