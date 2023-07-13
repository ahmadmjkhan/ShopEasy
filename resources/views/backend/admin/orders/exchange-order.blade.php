@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Orders
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>EXCHANGE REQUESTS</b>
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
                            <th>Order ID</th>


                            <th>User ID</th>
                            <th>Product Size</th>
                            <th>Required Size</th>
                            <th>Product Code</th>


                            <th>Exchange Reason</th>
                            <th>Exchange Status</th>
                            <th>Comment</th>

                            <th>Date</th>
                            <th>Approve/Reject</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exchange_request as $exchange)
                        <tr>
                            <td>{{$exchange['id']}}</td>


                            <td>{{$exchange['user_id']}}</td>

                            <td>{{$exchange['product_size']}}</td>
                            <td>{{$exchange['required_size']}}</td>
                            <td>{{$exchange['product_code']}}</td>

                            <td>{{$exchange['exchange_reason']}}</td>

                            <!--- Status Active/Inactive --->


                            <td>{{$exchange['exchange_status']}}</td>
                            <td>{{$exchange['comment']}}</td>
                            <td>{{date('Y-m-d h:i:s',strtotime($exchange['created_at']))}}</td>

                            <td>
                                <form action="{{route('admin.exchange-requests-update')}}" method="post">@csrf
                                    <input type="hidden" name="exchange_id" value="{{$exchange['id']}}">
                                    <select name="exchange_status" id="" class="form-control">
                                        <option @if($exchange['exchange_status']=="Approved" ) selected="" @endif value="Approved">Approved</option>
                                        <option @if($exchange['exchange_status']=="Pending" ) selected="" @endif value="Pending">Pending</option>
                                        <option @if($exchange['exchange_status']=="Rejected" ) selected="" @endif value="Rejected">Rejected</option>
                                    </select>
                                    <input type="submit" class="btn btn-info btn-sm" value="Update">
                                </form>

                            </td>
                            @endforeach







                    </tbody>
                    <tfoot class="table-danger">
                        <tr>
                            <th>Order ID</th>


                            <th>User ID</th>
                            <th>Product Size</th>
                            <th>Required Size</th>
                            <th>Product Code</th>


                            <th>Exchange Reason</th>
                            <th>Exchange Status</th>
                            <th>Comment</th>

                            <th>Date</th>
                            <th>Approve/Reject</th>
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