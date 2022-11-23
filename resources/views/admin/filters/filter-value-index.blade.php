<?php
use App\Models\ProductsFilter;
use App\Models\ProductsFilterValues;

?>
@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="float-start">ALL FILTERS VALUES
        <a href="{{route('admin.filter_values_store')}}" class="float-right btn btn-info">ADD FILTERS VALUE</a>
        </h4>
    </div>
    <!-- /.card-header -->
    <div class="card-body page-reload">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
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
                    <td>{{$filter_value->id}}</td>
                    <td>{{$filter_value->filter_id}}</td>
                    <td>
                        <?php
                        echo $getFilterName = ProductsFilterValues::getfiltername($filter_value->filter_id);   
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
                    <td><a href="{{route('admin.filter_values_store',$filter_value->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-filled"></i></i></a>
                        <!-- <a href="" class="btn btn-info btn-sm">Delete</a> -->
                        <form action="{{route('admin.delete_filter_values',$filter_value->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>
                    </td>
                    </td>
                    @endforeach




            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Filter ID</th>
                    
                    <th>Filter Values</th>
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