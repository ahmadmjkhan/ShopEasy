@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Shipping Charges
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">


                <div class="card shadow-lg p-3 mb-5 bg-light rounded">
                    <div class="card-header bg-info">
                        <h5 class="text-center"><b>ALL SHIPPING CHARGES</b>

                            <a href="{{route('admin.bulk-delete-section')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>

                           
                        </h5>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped page-reload">
                            <thead class="table-success">
                                <tr>
                                    <th>

                                        <input type="checkbox" class="master">

                                    </th>
                                    <th>ID</th>
                                    <th>Country</th>
                                    <th>Rate(0g to 500g)</th>
                                    <th>Rate(501g to 1000g)</th>
                                    <th>Rate(1001g to 2000g)</th>
                                    <th>Rate(2001g to 5000g)</th>
                                    <th>Rate(Above 5000g)</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-secondary">
                                @foreach($all_charges as $charge)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$charge['id']}}">
                                    </td>
                                    <td>{{$charge['id']}}</td>
                                    <td>{{$charge['country']}}</td>
                                    <td>{{$charge['0_500g']}}</td>
                                    <td>{{$charge['501_1000g']}}</td>
                                    <td>{{$charge['1001_2000g']}}</td>
                                    <td>{{$charge['2001_5000g']}}</td>
                                    <td>{{$charge['above_5000g']}}</td>

                                    <!--- Status Active/Inactive --->
                                    <td>

                                        @if($charge['status'] == '1')
                                        <a href="javascript:void(0)" class="updateshippingchargestatus" id="shipping-charge-{{$charge['id']}}" charge_id="{{$charge['id']}}">
                                            <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="updateshippingchargestatus" id="shipping-charge-{{$charge['id']}}" charge_id="{{$charge['id']}}">
                                            <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                        </a>
                                        @endif

                                    </td>

                                    <!--- Status in Active closed --->
                                    <td><a href="{{url('admin/add-edit-shipping-charges',$charge['id'])}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>

                                        <form action="{{route('admin.delete_charge',$charge['id'])}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                    </td>
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
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection