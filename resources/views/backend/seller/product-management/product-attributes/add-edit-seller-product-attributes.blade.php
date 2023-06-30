@extends('backend.seller.layouts.seller-master-layout')

@section('content')





<div class="min-height-200px">
    <div class="page-header">


        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Add Attribute</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Attribute
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
                    <h5 class="text-center text-white"><b>Attributes</b>

                        <a href="{{route('seller.product_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                    </h5>

                </div>

                <div class="card-body">


                    <form action="{{url('seller/add-edit-attributes',$products->id)}}" method="post" class="form_operation">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="invoice-col">
                                    <b>Product Name : {{$products->product_name}}</b><br>
                                    <br>
                                    <b>Product Code:</b>{{$products->product_code}}<br>
                                    <b>Product Price:</b>{{$products->product_code}}<br>
                                    <b>Product Color</b>{{$products->product_color}}


                                </div>

                                <div class="pt-3">
                                    <img src="{{url('uploads/catalogue-images/products/small/'.$products->product_image)}}" alt="" width="100">
                                </div>
                            </div>





                            <div class="col-md-8">
                                <div class="field_wrapper">
                                    <input type="text" name="size[]" id="size" placeholder="Size" style="width:120px" required="">
                                    <input type="text" name="sku[]" id="sku" placeholder="Sku" style="width:120px" required="">
                                    <input type="text" name="price[]" placeholder="price" style="width:120px" required="">
                                    <input type="text" name="stock[]" placeholder="Stock" style="width:120px" required="">
                                    <a href="javascript:void(0);" class="add_button btn btn-sm btn-success">Add</a>
                                    <span class="text-danger" id="check_size"></span>
                                </div>
                                <div> <input type="submit" class="btn btn-sm btn-danger mt-2" value="Submit"></div>
                            </div>
                        </div>


                    </form>




                    <form action="{{route('seller.edit_attributes',$products->id)}}" method="post" >@csrf
                        <div class="card mt-5">
                            <div class="card-header bg-info">
                                <h5 class="text-center text-white">All Attributes</h5>
                            </div>
                            <div class="card-body">
                                @if(Session::has('success_message'))

                                <div class="alert alert-success">
                                    {{Session::get('success_message')}}
                                </div>
                                @endif
                                <table class="table hover data-table-export nowrap page-reload">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Size</th>
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products->attributes as $attribute)
                                        <input style="display:none" type="text" name="attributeId[]" value="{{$attribute->id}}" />
                                        <tr>

                                            <td>{{$attribute->id}}</td>
                                            <td>{{$attribute->size}}</td>
                                            <td>{{$attribute->sku}}</td>



                                            <td>
                                                <input type="text" name="price[]" value="{{$attribute->price}}">
                                            </td>
                                            <td>
                                                <input type="number" name="stock[]" value="{{$attribute->stock}}">
                                            </td>

                                            <!--- Status Active/Inactive --->


                                            <td>

                                                @if($attribute->status == '1')
                                                <a href="javascript:void(0)" class="updateattributestatus" id="attribute-{{$attribute->id}}" attribute_id="{{$attribute->id}}">
                                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                                </a>
                                                @else
                                                <a href="javascript:void(0)" class="updateattributestatus" id="attribute-{{$attribute->id}}" attribute_id="{{$attribute->id}}">
                                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="Active"></i>
                                                </a>
                                                @endif

                                               
                                            </td>




                                            @endforeach




                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Size</th>
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div><input type="submit" class="btn btn-primary" value="Update Attribute"></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection