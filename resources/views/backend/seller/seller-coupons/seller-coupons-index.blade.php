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
                    <h4>Add Coupons</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Coupons
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-info">


            <h5 class="text-white">Add Coupon
                <a href="{{route('seller.seller_coupon_store')}}" class="float-end btn btn-sm btn-danger float-right">ADD PRODUCTS</a>
            </h5>

        </div>

        <div class="card-body ">
            <table class="table hover data-table-export nowrap page-reload">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Coupon Code</th>
                        <th>Coupon Type</th>
                        <th>Amount</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">

                    @foreach($allcoupons as $coupon)



                    <tr>
                        <td>{{$coupon->id}}</td>
                        <td>{{$coupon->coupon_code}}</td>
                        <td>{{$coupon->coupon_type}}</td>
                        <td>{{$coupon->amount}}</td>
                        <td>{{$coupon->expiry_date}}</td>


                        <td>

                            <!--- Status Active/Inactive --->
                            @if($coupon->status == '1')
                            <a href="javascript:void(0)" class="updatecouponstatus" id="seller_coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}">
                                <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                @else
                                <a href="javascript:void(0)" class="updatecouponstatus" id="seller_coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif
                                <!--- Status in Active closed --->

                        </td>

                        <td>

                            <a href="{{url('seller/add-edit-coupons',$coupon->id)}}" title="Edit Coupon" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fa fa-edit"></i></a>

                            <form action="{{route('seller.seller_delete_coupons',$coupon->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                <button class="btn btn-sm btn-danger"><i class="icon-copy fa fa-trash"></i></button>
                            </form>

                        </td>

                    </tr>
                    @endforeach

                    </tfoot>
            </table>
        </div>

    </div>
</div>

@endsection