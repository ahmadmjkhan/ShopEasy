@extends('layouts.admin')

@section('content')

<div class="card p-3 m-3">
    <div class="card-body">
        <!-- title row -->
        <div class="row">

            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> Add Multiple Images
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
                    <img src="{{url('uploads/images/products/small/'.$products->product_image)}}" alt="" width="100">
                </div>



                <div class="field_wrapper">
                    <input type="file" name="images[]" multiple="" id="images">

                </div>

                <div> <input type="submit" class="btn-danger" value="Submit"></div>
            </form>
            <!-- /.col -->
        </div>
    </div>


    <div class="row">
        <table id="example1" class="table table-bordered table-striped">
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
                    <td><img src="{{url('uploads/images/products/multiple-images/small/',$image->images)}}" alt="" width="50"></td>

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
<!-- /.row -->






@endsection