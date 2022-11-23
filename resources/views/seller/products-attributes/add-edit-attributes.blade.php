@extends('layouts.seller')

@section('content')

<div class="card p-3 m-3">
    <div class="card-body">
        <!-- title row -->
        <div class="row">

            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Add Attributes
                    <!-- <small class="float-right">Date: 2/10/2014</small> -->
                </h4>
                <!-- @if(Session::has('error_message'))

                     <div class="alert-danger">
                        <strong>Error:</strong>{{Session::get('error_message')}}
                     </div>
                @endif -->

                @if(Session::has('success_message'))

                     <div class="alert-success">
                        {{Session::get('success_message')}}
                     </div>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info pt-3">

            <form action="{{url('seller/add-edit-attributes',$products->id)}}" method="post" class="form_operation">
                @csrf

                <div class="invoice-col">
                    <b>Product Name : {{$products->product_name}}</b><br>
                    <br>
                    <b>Product Code:</b>{{$products->product_code}}<br>
                    <b>Product Price:</b>{{$products->product_code}}<br>
                    <b>Product Color</b>{{$products->product_color}}


                </div>

                <div class="pt-3">
                    <img src="{{url('uploads/images/products/small/'.$products->product_image)}}" alt="" width="100">
                </div>



                <div class="field_wrapper">
                    <input type="text" name="size[]" id="size" placeholder="Size" style="width:120px" required="">
                    <input type="text" name="sku[]" id="sku" placeholder="Sku" style="width:120px" required="">
                    <input type="text" name="price[]" placeholder="price" style="width:120px" required="">
                    <input type="text" name="stock[]" placeholder="Stock" style="width:120px" required="">
                    <a href="javascript:void(0);" class="add_button">Add</a>
                    <span class="text-danger" id="check_size"></span>
                </div>

                <div> <input type="submit" class="btn-danger" value="Submit"></div>
            </form>
            <!-- /.col -->
        </div>
    </div>

    <form action="{{route('admin.edit_attributes',$products->id)}}" method="post">@csrf
        <table id="example1" class="table table-bordered table-striped">
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

    </form>


</div>
<!-- /.row -->






@endsection