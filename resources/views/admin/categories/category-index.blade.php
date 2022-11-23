@extends('layouts.admin')

@section('title')
All Category
@endsection

@section('content')

<div class="card shadow">
    <div class="card-header">
        <h4 class="float-start">Add Category
            <a href="{{route('admin.category_store')}}" class="float-right btn btn-info">ADD CATEGORY</a>
        </h4>
    </div>

    <div class="card-body page-reload">
        <table  class="table stripe data-table-export nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Parent Category</th>

                    <th>Section</th>
                    <th>Status</th>
                    <th>Popular</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($category as $cat)
                @if(isset($cat->parentcategory->category_name)&&!empty($cat->parentcategory->category_name))

                @php $parent_category = $cat->parentcategory->category_name; @endphp
                @else
                @php $parent_category = "ROOT"; @endphp
                @endif


                <tr>
                    <td>{{$cat->id}}</td>
                    <td><img src="{{asset('uploads/images/categories/'.$cat->category_image)}}" width="80" height="80" alt=""></td>
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



                        <a href="{{url('admin/add-edit-category',$cat->id)}}" title="Edit Category" class="float-center mx-1 btn-sm btn btn-primary"><i class="icon-copy fi-page-filled"></i></a>

                        <form action="{{route('admin.delete_category',$cat->id)}}" class="delete_form_operation " style="display:inline;" method="post">@csrf
                            <button class="btn btn-sm btn-danger"><i class="icon-copy fi-trash"></i></button>
                        </form>

                    </td>

                </tr>
                @endforeach

                </tfoot>
        </table>
    </div>



    @endsection