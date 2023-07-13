@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Orders
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>REVIEWS AND RATINGS</b>
                </h5>

            </div>
            <!-- /.card-header -->

            @if(Session::has('success_message'))

            <div class="alert alert-success">
                {{Session::get('success_message')}}
            </div>
            @endif
            @if(Session::has('error_message'))

            <div class="alert alert-danger">z
                {{Session::get('error_message')}}
            </div>
            @endif
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped page-reload checkbox-datatable">
                    <thead class="table-danger">
                        <tr>
                            <th>ID</th>


                            <th>Product Name</th>
                            <th>User Email</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ratings as $rating)
                        <tr>
                            <td>{{$rating['id']}}</td>


                            <td>{{$rating['product']['product_name']}}</td>

                            <td>{{$rating['user']['email']}}</td>
                            <td>{{$rating['reviews']}}</td>
                            <td>{{$rating['rating']}}</td>

                            <td>
                                @if($rating['status'] == '1')
                                <a href="javascript:void(0)" class="updateratingstatus text-primary " id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}">

                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updateratingstatus text-primary" id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif
                            </td>

                            <!--- Status Active/Inactive --->

                            @endforeach







                    </tbody>
                    <tfoot class="table-danger">
                        <tr>
                            <th>ID</th>


                            <th>Product Name</th>
                            <th>User Email</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>

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