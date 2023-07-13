@extends('backend.admin.layouts.admin-master-layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Invoice
                        <small class="float-right">Date: {{date('d-m-Y',strtotime($orderDetails['created_at']))}}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Billed To
                    <address>
                        <strong>{{$userDetails['name']}}</strong><br>
                        @if(!empty($userDetails['address']))
                        {{$userDetails['address']}}<br>
                        @endif

                        @if(!empty($userDetails['city']))
                        {{$userDetails['city']}},
                        @endif
                        @if(!empty($userDetails['state']))
                        {{$userDetails['state']}},
                        @endif
                        @if(!empty($userDetails['pincode']))
                        {{$userDetails['pincode']}}<br>
                        @endif

                        @if(!empty($userDetails['phone']))
                        Phone:{{$userDetails['phone']}}<br>
                        @endif
                        @if(!empty($userDetails['email']))
                        Email: {{$userDetails['email']}}<br>
                        @endif
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Shipped To
                    <address>
                        <strong>{{$orderDetails['name']}}</strong><br>

                        {{$orderDetails['address']}}<br>

                        {{$orderDetails['city']}},

                        {{$orderDetails['state']}},

                        {{$orderDetails['pincode']}}<br>

                        Phone:{{$orderDetails['phone']}}<br>
                        Email: {{$orderDetails['email']}}<br>

                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>Order ID:</b> {{$orderDetails['id']}} @php echo DNS1D::getBarcodeHTML($orderDetails['id'],'C39') @endphp </br>


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Product</th>
                                <th>Serial #</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $subtotal = 0 @endphp
                            @foreach($orderDetails['order_products'] as $product)
                            <tr>
                                <td>{{$product['product_quantity']}}</td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$product['product_code']}}@php echo DNS1D::getBarcodeHTML($product['product_code'],'C39') @endphp</td>
                                <td>{{$product['product_color']}}</td>
                                <td>Rs {{$product['product_price']}}</td>
                                <td>INR {{$product['product_quantity']*$product['product_price']}}</td>
                            </tr>
                            @php $subtotal = $subtotal+($product['product_price']*$product['product_quantity']) @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead"><b>Payment Methods:</b></p>


                    <p class=" well well-sm shadow-none" style="margin-top: 10px;">
                        {{$orderDetails['payment_method']}}
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">


                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>Rs {{$subtotal}}</td>
                            </tr>
                            <tr>
                                <th>Tax ({{$orderDetails['gst_charges']/$subtotal*100 }}%)</th>
                                <td>Rs {{$orderDetails['gst_charges']}}</td>
                            </tr>
                            <tr>
                                <th>Shipping Charges:</th>
                                <td>Rs {{$orderDetails['shipping_charges']}}</td>
                            </tr>
                            <tr>
                                <th>Grand Total:</th>
                                <td>
                                    <strong>Rs {{$orderDetails['grand_total']}}</strong><br>
                                    @if($orderDetails['payment_method'] == 'COD')
                                    <span class="text-danger">Already Paid</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                        Payment
                    </button>
                    <a href="{{route('admin.pdf_order_invoice',$orderDetails['id'])}}" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </a>
                </div>
            </div>
        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
</div><!-- /.row -->


@endsection