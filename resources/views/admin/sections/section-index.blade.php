@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="float-start">ALL SECTIONS
            <a href="{{route('admin.section_store')}}" class="float-right btn btn-info">ADD SECTION</a>
        </h4>
    </div>
    <!-- /.card-header -->
    <div class="card-body page-reload">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Section Name</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($all_section as $section)
                <tr>
                    <td>{{$section->id}}</td>
                    <td>{{$section->section_name}}</td>

                    <!--- Status Active/Inactive --->
                    <td>

                        @if($section->status == '1')
                        <a href="javascript:void(0)" class="updatesectionstatus" id="section-{{$section->id}}" section_id="{{$section->id}}">
                        <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" class="updatesectionstatus" id="section-{{$section->id}}" section_id="{{$section->id}}">
                        <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                        </a>
                        @endif

                    </td>

                    <!--- Status in Active closed --->
                    <td><a href="{{url('admin/add-edit-sections',$section->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-filled"></i></a>
                       
                        <form action="{{route('admin.delete_section',$section->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>
                    </td>
                    </td>
                    @endforeach




            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Section Name</th>
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