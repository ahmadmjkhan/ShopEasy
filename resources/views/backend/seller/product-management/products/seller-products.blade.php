@extends('backend.seller.layouts.seller-master-layout')

@section('content')

<div class="min-height-200px">
    <div class="page-header">


        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Products</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Products
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="text-white">All Products
                        <a href="{{route('seller.add-edit-products')}}" class="float-end btn btn-sm btn-danger float-right">ADD PRODUCTS</a>
                    </h5>

                </div>
                <div class="card-body">
                    <table class="table hover data-table-export nowrap">
                        <thead class="table-success">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Product Color</th>
                                <th>Category</th>
                                <th>Section</th>


                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-secondary">
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img src="{{url('uploads/catalogue-images/products/small/'.$product->product_image)}}" alt="" width="100"></td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_code}}</td>
                                <td>{{$product->product_color}}</td>
                                <td>{{$product->categories->category_name}}</td>
                                <td>{{$product->section->section_name}}</td>



                                <td>
                                    <a href="{{route('seller.add-edit-products',$product->id)}}" title="Edit Category" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>

                                    <a href="{{route('seller.add_edit_attributes',$product->id)}}" title="Add Attributes" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fa fa-plus-square" aria-hidden="true"></i></a>

                                    <a href="{{route('seller.add_multiple_images',$product->id)}}" title="Add Multiple Images" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fa fa-file-picture-o" aria-hidden="true"></i></a>


                                    <form action="{{route('seller.delete_product',$product->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                        <button class="btn btn-sm btn-danger"><i class="icon-copy fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>


                                @endforeach




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





</div>

@endsection