@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Sections
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">


                <div class="card shadow-lg p-3 mb-5 bg-light rounded">
                    <div class="card-header bg-info">
                        <h5 class="text-center"><b>ALL SECTIONS</b>

                            <a href="{{route('admin.bulk-delete-section')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>

                            <a href="{{route('admin.section_store')}}" class="btn bg-gradient-danger btn-sm float-right">Add Section</a>
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
                                    <th>Section Name</th>
                                    <th>Section Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-secondary">
                                @foreach($all_section as $section)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$section->id}}">
                                    </td>
                                    <td>{{$section->id}}</td>
                                    <td><img src="{{asset('uploads/catalogue-images/sections/'.$section->section_image)}}" alt="NO image" style="width: 80px;height: 50px;"></td>
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
                                    <td><a href="{{url('admin/add-edit-sections',$section->id)}}" title="Edit Section" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>

                                        <form action="{{route('admin.delete_section',$section->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
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