@extends('backend.seller.layouts.seller-master-layout')

@section('title')
All Category
@endsection

@section('content')


<div class="min-height-200px">
    <div class="page-header">


        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Orders</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Orders
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-info">
            <h4 class="float-start text-white">Orders

            </h4>
        </div>

        <div class="card-body page-reload">

            <table class="table hover data-table-export nowrap">
                <thead class="table-success">
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


                    @if(!empty($orders))
                    @foreach($orders as $order)
                    @if(!empty($order['order_products']))
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

                        <td><a href="{{route('seller.order-seller-details',$order['id'])}}"><i class="fas fa-edit"></a></i></td>
                    </tr>

                    @endif
                    @endforeach
                    @else
                    <h4>No Products</h4>
                    @endif



                </tbody>

                <tfoot class="table-success">
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

    </div>
</div>

@endsection