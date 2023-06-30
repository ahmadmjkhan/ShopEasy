@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Attribute
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>Attributes</b>

                    <a href="{{route('admin.product_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
                <form action="{{url('admin/add-edit-attributes',$products->id)}}" method="post" class="form_operation">
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="invoice-col">
                                        <b>Product Name : {{$products->product_name}}</b><br>
                                        <b>Product Code :</b>{{$products->product_code}}<br>
                                        <b>Product Price:</b>Rs:{{$products->product_price}}<br>
                                        <b>Product Color:</b>{{$products->product_color}}


                                    </div>

                                    <div class="pt-3 mt">
                                        <img src="{{url('uploads/catalogue-images/products/small/'.$products->product_image)}}" alt="" class="img-thumbnail" width="100">
                                    </div>
                                </div>



                                <div class="col-md-8">
                                    <div class="field_wrapper mt-3">
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
                        </div>
                    </div>








                </form>




                <form action="{{route('admin.edit_attributes',$products->id)}}" method="post">@csrf
                    <div class="card mt-5">
                        <div class="card-header bg-primary">
                            <h5 class="text-center">All Attributes</h5>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success_message'))

                            <div class="alert alert-success">
                                {{Session::get('success_message')}}
                            </div>
                            @endif
                            <table id="example1" class="table table-bordered table-striped page-reload">
                                <thead class="table-success">
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
                                <tfoot class="table-success">
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
        <!-- /.card -->
    </div>
</div>

@endsection