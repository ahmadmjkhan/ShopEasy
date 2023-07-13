@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Orders
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL ORDERS</b>
                </h5>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped page-reload checkbox-datatable">
                    <thead class="table-danger">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date </th>

                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Ordered Products</th>


                            <th>Order Amount</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order['id']}}</td>
                            <td>{{date('Y-m-d h:i:s',strtotime($order['created_at']))}}</td>

                            <td>{{$order['name']}}</td>

                            <td>{{$order['email']}}</td>

                            <td>@foreach($order['order_products'] as $product)
                                {{$product['product_code']}} ({{$product['product_quantity']}})
                                @endforeach
                            </td>

                            <!--- Status Active/Inactive --->


                            <td>{{$order['grand_total']}}</td>
                            <td>{{$order['order_status']}}</td>
                            <td>{{$order['payment_method']}}</td>

                            <td>
                                @if($orderModule['edit_access']==1 || $orderModule['full_access']==1)
                                <a href="{{route('admin.order-details',$order['id'])}}" title="View Order Details"><i class="icon-copy fas fa-eye" aria-hidden="true"></i></a>
                                <a href="{{route('admin.order_invoice',$order['id'])}}" title="order Invoice"><i class="icon-copy fas fa-print" aria-hidden="true"></i></a>
                                <a href="{{route('admin.pdf_order_invoice',$order['id'])}}" title="Generate PDF Invoice"><i class="icon-copy fas fa-file" aria-hidden="true"></i></a>
                                @endif
                            </td>
                            @endforeach







                    </tbody>
                    <tfoot class="table-danger">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date </th>

                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Ordered Products</th>


                            <th>Order Amount</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>

                            <th>Action</th>
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