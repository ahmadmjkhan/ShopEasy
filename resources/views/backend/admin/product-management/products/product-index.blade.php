@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Brands
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL PRODUCTS</b>


                    <a href="{{route('admin.bulk-delete-products')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>

                    <a href="{{route('admin.product_store')}}" class="btn bg-gradient-danger btn-sm float-right">Add Product</a>
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
                            <th class="table-plus datatable-nosort">ID</th>
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
                            <td>
                                <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$product->id}}">
                            </td>
                            <td>{{$product->id}}</td>
                            <td><img src="{{url('uploads/catalogue-images/products/small/'.$product->product_image)}}" alt="" width="100"></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_code}}</td>
                            <td>{{$product->product_color}}</td>
                            <td>{{$product->categories->category_name}}</td>
                            <td>{{$product->section->section_name}}</td>
                            <td>
                                @if($product->added_by == 'Admin')
                                {{$product->added_by}}

                                @else

                                {{$product->added_by}}(seller)
                                @endif

                            </td>
                            <!--- Status Active/Inactive --->
                            <td>
                                @if($productModule['edit_access']==1 || $productModule['full_access']==1)
                                @if($product->status == '1')
                                <a href="javascript:void(0)" class="updateproductstatus" id="products-{{$product->id}}" product_id="{{$product->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updateproductstatus" id="products-{{$product->id}}" product_id="{{$product->id}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @endif
                                @endif
                            </td>

                            <!--- Status in Active closed --->

                            <td>
                                @if($productModule['edit_access']==1 || $productModule['full_access']==1)
                                <a href="{{route('admin.product_store',$product->id)}}" title="Edit Category" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>

                                <a href="{{route('admin.add_edit_attributes',$product->id)}}" title="Add Attributes" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-folder-plus"></i></a>

                                <a href="{{route('admin.add_multiple_images',$product->id)}}" title="Add Multiple Images" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-images"></i></a>
                                @endif
                                @if($productModule['full_access']==1)

                                <form action="{{route('admin.delete_product',$product->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                                @endif
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