@extends('backend.admin.layouts.admin-master-layout')

@section('title')
Categories
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">


        <div class="card shadow-lg p-3 mb-5 bg-light rounded ">
            <div class="card-header bg-info">
                <h5 class="text-center"><b>ALL CATEGORIES</b>


                    <a href="{{route('admin.bulk-delete-categories')}}" class="btn bg-gradient-danger btn-sm ml-3 float-right delete-all" style="display:none" data-url="">Delete Selected</a>

                    <a href="{{route('admin.category_store')}}" class="btn bg-gradient-danger btn-sm float-right">Add Category</a>
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
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>Parent Category</th>

                            <th>Section</th>
                            <th>Status</th>
                            <th>Popular</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">


                        @foreach($category as $cat)
                        @if(isset($cat->parentcategory->category_name)&&!empty($cat->parentcategory->category_name))

                        @php $parent_category = $cat->parentcategory->category_name; @endphp
                        @else
                        @php $parent_category = "ROOT"; @endphp
                        @endif



                        <tr>
                            <td>
                                <input type="checkbox" name="sub_chk" class="sub_chk" data-id="{{$cat->id}}">
                            </td>
                            <td>{{$cat->id}}</td>
                            <td><img src="{{asset('uploads/catalogue-images/categories/'.$cat->category_image)}}" width="80" height="80" alt=""></td>
                            <td>{{$cat->category_name}}</td>
                            <td>{{$parent_category}}</td>
                            <td>{{$cat->section->section_name}}</td>


                            <td>

                                <!--- Status Active/Inactive --->
                                @if($cat->status == '1')
                                <a href="javascript:void(0)" class="updatecategorystatus" id="category-{{$cat->id}}" category_id="{{$cat->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                    @else
                                    <a href="javascript:void(0)" class="updatecategorystatus" id="category-{{$cat->id}}" category_id="{{$cat->id}}">
                                        <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                    </a>
                                    @endif
                                    <!--- Status in Active closed --->

                            </td>
                            <td>

                                <!--- Status Active/Inactive --->
                                @if($cat->popular == '1')
                                <a href="javascript:void(0)" class="updatepopularcategory" id="popular-{{$cat->id}}" category_id="{{$cat->id}}">
                                    <i class="icon-copy fa fa-toggle-on fa-lg" aria-hidden="true" status="Active"></i>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="updatepopularcategory" id="popular-{{$cat->id}}" category_id="{{$cat->id}}">
                                    <i class="icon-copy fa fa-toggle-off fa-lg" aria-hidden="true" status="InActive"></i>
                                </a>
                                @endif
                                <!--- Status in Active closed --->

                            </td>
                            <td>
                                <a href="" title="View Category" class="float-left btn-sm btn btn-primary mx-1"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>



                                <a href="{{url('admin/add-edit-category',$cat->id)}}" title="Edit Category" class="float-center mx-1 btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>

                                <form action="{{route('admin.delete_category',$cat->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
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


@endsection