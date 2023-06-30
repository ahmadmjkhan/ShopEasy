@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Coupons
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL COUPONS</b>


                    <a href="{{route('admin.bulk-delete-coupons')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>

                    <a href="{{route('admin.coupon_store')}}" class="btn bg-gradient-danger btn-sm float-right">Add Coupon</a>
                </h5>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped page-reload checkbox-datatable">
                    <thead class="table-success">

                        <tr>


                            <th>

                                <input type="checkbox" class="master">

                            </th>
                            <th>#</th>
                            <th>Coupon Option</th>
                            <th>Coupon Code</th>
                            <th>Coupon Type</th>
                            <th>Added By</th>
                            <th>Amount</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($allcoupons as $coupon)



                        <tr>
                            <td>
                                <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$coupon->id}}">
                            </td>
                            <td>{{$coupon->id}}</td>
                            <td>{{$coupon->coupon_option}}</td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->coupon_type}}</td>
                            @if($coupon->admin_id)
                            <td>Admin</td>
                            @else
                            <td>{{$coupon->seller_coupon->name}}(seller)</td>
                            @endif
                            <td>{{$coupon->amount}}</td>
                            <td>{{$coupon->expiry_date}}</td>


                            <td>

                                <!--- Status Active/Inactive --->
                                @if($coupon->status == '1')
                                <a href="javascript:void(0)" class="updatecouponstatus" id="coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                    @else
                                    <a href="javascript:void(0)" class="updatecouponstatus" id="coupon-{{$coupon->id}}" coupon_id="{{$coupon->id}}">
                                        <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                    </a>
                                    @endif
                                    <!--- Status in Active closed --->

                            </td>

                            <td>

                                <a href="{{url('admin/add-edit-coupons',$coupon->id)}}" title="Edit Coupon" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>

                                <form action="{{route('admin.delete_coupons',$coupon->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>

                            </td>

                        </tr>
                        @endforeach

                    </tbody>


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