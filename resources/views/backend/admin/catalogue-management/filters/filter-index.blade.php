<?php

use App\Models\Category; ?>
@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Filters
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL FILTER</b>


                    <a href="{{route('admin.bulk-delete-filters')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>


                    <a href="{{route('admin.filter_store')}}" class="float-right btn btn-primary ml-3">ADD FILTER COLUMNS</a>
                    <a href="{{route('admin.filter_values_index')}}" class="float-right btn btn-success">VIEW FILTERS VALUE</a>

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
                            <th>ID</th>
                            <th>Filter Name</th>
                            <th>Filter Column</th>
                            <th>Categories</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_filters as $filter)
                        <tr>
                            <td>
                                <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$filter->id}}">
                            </td>
                            <td>{{$filter->id}}</td>
                            <td>{{$filter->filter_name}}</td>
                            <td>{{$filter->filter_column}}</td>
                            <td>
                                <?php



                                $catIds = explode(",", $filter->cat_ids);

                                foreach ($catIds as $catId) {
                                    $category_name = Category::getcategoryname($catId);
                                    // dd($category_name);
                                    echo $category_name . ",";
                                }
                                ?>
                            </td>

                            <!--- Status Active/Inactive --->
                            <td>

                                @if($filter->status == '1')
                                <a href="javascript:void(0)" class="updatefilterstatus" id="filter-{{$filter->id}}" filter_id="{{$filter->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updatefilterstatus" id="filter-{{$filter->id}}" filter_id="{{$filter->id}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif

                            </td>

                            <!--- Status in Active closed --->
                            <td><a href="{{route('admin.filter_store',$filter->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                <!-- <a href="" class="btn btn-info btn-sm">Delete</a> -->
                                <form action="{{route('admin.delete_filter',$filter->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
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