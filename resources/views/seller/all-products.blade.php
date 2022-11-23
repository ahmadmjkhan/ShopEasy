@extends('layouts.seller')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="card-header">


            </div>
        </div>
    </div>
    <section class="section">
        <div class="card page-reload">
            <div class="card-header">
                
                    <a href="{{route('seller.add-edit-products')}}" class="float-end btn btn-info">ADD PRODUCTS</a>
                
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
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
                                <a href="{{route('seller.add-edit-products',$product->id)}}" title="Edit Category" class="float-center mx-1 btn-sm btn btn-primary"><span class="fa-fw select-all fas"></span></a>

                                <a href="{{route('seller.add_edit_attributes',$product->id)}}" title="Add Attributes" class="float-center mx-1 btn-sm btn btn-primary"><span class="fa-fw select-all fas"></span></a>

                                <a href="{{route('seller.add_multiple_images',$product->id)}}" title="Add Multiple Images" class="float-center mx-1 btn-sm btn btn-primary"><span class="fa-fw select-all fas"></span></a>


                                <form action="{{route('seller.delete_product',$product->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                    <button class="btn btn-sm btn-danger"><span class="fa-fw select-all fas"></span></button>
                                </form>
                            </td>


                            @endforeach




                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@endsection