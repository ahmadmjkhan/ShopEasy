<?php

use App\Models\Category;
?>

@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="float-start">ALL FILTERS
            <a href="{{route('admin.filter_store')}}" class="float-start btn btn-info">ADD FILTERS COLUMNS</a>
            <a href="{{route('admin.filter_values_index')}}" class="float-right btn btn-info">VIEW FILTERS VALUE</a>
        </h4>
    </div>
    <!-- /.card-header -->
    <div class="card-body page-reload">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
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
                    <td><a href="{{route('admin.filter_store',$filter->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-filled"></i></a>
                        <!-- <a href="" class="btn btn-info btn-sm">Delete</a> -->
                        <form action="{{route('admin.delete_filter',$filter->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>
                    </td>
                    </td>

                    @endforeach




            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Filter Name</th>
                    <th>Filter Column</th>
                    <th>Categories</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
</div>
@endsection