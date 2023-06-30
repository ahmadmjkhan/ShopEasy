<?php

use App\Models\Category;
use App\Models\ProductFilterValue;

?>
@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Filter Values
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL FILTER VALUES</b>


                    <a href="{{route('admin.bulk-delete-filters-values')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>


                    <a href="{{route('admin.filter_values_index')}}" class="float-right btn btn-primary">BACK</a>
                    <a href="{{route('admin.filter_values_store')}}" class="float-right btn btn-success mr-3">ADD FILTERS VALUE</a>

                </h5>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped page-reload checkbox-datatable">
                    <thead>
                        <tr>
                            <th>

                                <input type="checkbox" class="master">

                            </th>
                            <th>ID</th>
                            <th>Filter ID</th>
                            <th>Filter Names</th>
                            <th>Filter Values</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_filters_values as $filter_value)
                        <tr>
                            <td>
                                <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$filter_value->id}}">
                            </td>
                            <td>{{$filter_value->id}}</td>
                            <td>{{$filter_value->filter_id}}</td>
                            <td>
                                <?php
                                echo $getFilterName = ProductFilterValue::getfiltername($filter_value->filter_id);
                                ?>
                            </td>
                            <td>{{$filter_value->filter_value}}</td>


                            <!--- Status Active/Inactive --->
                            <td>

                                @if($filter_value->status == '1')
                                <a href="javascript:void(0)" class="updatefiltervaluestatus" id="filter_value-{{$filter_value->id}}" filter_value_id="{{$filter_value->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updatefiltervaluestatus" id="filter_value-{{$filter_value->id}}" filter_value_id="{{$filter_value->id}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif

                            </td>

                            <!--- Status in Active closed --->
                            <td><a href="{{route('admin.filter_values_store',$filter_value->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></i></a>
                                <!-- <a href="" class="btn btn-info btn-sm">Delete</a> -->
                                <form action="{{route('admin.delete_filter_values',$filter_value->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
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




@section('script')

<script>

</script>


@endsection


@endsection