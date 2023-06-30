@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Add-Edit Multiple Images
@endsection


@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="text-center"><b>Add Multiple Images</b>

                    <a href="{{route('admin.product_index')}}" class="btn btn-sm btn-success float-right">BACK</a>
                </h5>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
                <form action="{{route('admin.add_multiple_images',$products->id)}}" method="post" enctype="multipart/form-data" class="form_operation">
                    @csrf

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



                    <div class="field_wrapper">
                        <input type="file" name="images[]" multiple="" id="images">

                    </div>

                    <div> <input type="submit" class="btn-danger" value="Submit"></div>
                </form>





                <div class="card mt-5">
                    <div class="card-header bg-primary">
                        <h5 class="text-center">All Images</h5>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success_message'))

                        <div class="alert alert-success">
                            {{Session::get('success_message')}}
                        </div>
                        @endif
                        <table id="example1" class="table table-bordered table-striped page-reload">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Images</th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products->multiple_images as $image)

                                <tr>

                                    <td>{{$image->id}}</td>
                                    <td><img src="{{url('uploads/catalogue-images/products/multiple-images/small/',$image->images)}}" alt="" width="50"></td>

                                    <!--- Status Active/Inactive --->


                                    <td>

                                        <!--- Status Active/Inactive --->
                                        @if($image->status == '1')
                                        <a href="javascript:void(0)" class="updatestatusimages" id="images-{{$image->id}}" image_id="{{$image->id}}">
                                            <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updatestatusimages" id="images-{{$image->id}}" image_id="{{$image->id}}">
                                            <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="Active"></i>
                                        </a>
                                        @endif
                                        <!--- Status in Active closed --->

                                        
                                        <form action="{{route('admin.delete_multiple_images',$image->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>

                                    </td>




                                    @endforeach

                                </tr>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>



            </div>






        </div>
        <!-- /.card -->
    </div>
</div>




@endsection