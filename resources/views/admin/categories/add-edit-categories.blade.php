@extends('layouts.admin')

@section('title')
Add Category
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header">

        <h4 class="text-center ">{{$title}}</h4>
    </div>
    

    <form @if(empty($category->id)) action="{{url('admin/add-edit-category')}}" @else action="{{url('admin/add-edit-category',$category->id)}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">

        @csrf
        <div class="card-body">
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">

                        <input type="text" id="form6Example1" name="category_name" class="form-control" placeholder="Category Name" @if(!empty($category->category_name)) value="{{$category->category_name}}" @else value="{{old('category_name')}}" @endif />
                        <span class="text-danger error-text category_name_error"></span>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">

                        <select name="section_id" id="section_id" class="form-control">
                            <option value="">Select Section</option>
                            @foreach($getsection as $section)
                            <option value="{{$section->id}}" @if(!empty($category->section_id) && $category->section_id == $section->id) selected="" @endif >{{$section->section_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text section_id_error"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="appendCategoriesLevel">
                        @include('admin.categories.append-category-level')
                    </div>


                </div>


                <div class="col-md-12">
                    <div class="form-group">

                        <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Description"> @if(!empty($category->description)) {{$category->description}}  @else {{old('description')}} @endif</textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <input type="text" id="form6Example2" name="category_discount" class="form-control" placeholder="Category Discount" @if(!empty($category->category_discount)) value="{{$category->category_discount}}" @else value="{{old('category_discount')}}" @endif />
                        <span class="text-danger error-text category_discount_error"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <input type="text" id="form6Example2" name="url" class="form-control" placeholder="URL" @if(!empty($category->url)) value="{{$category->url}}" @else value="{{old('url')}}" @endif />
                        <span class="text-danger error-text url_error"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <input type="text" id="form6Example2" name="meta_title" class="form-control" placeholder="Meta Title" @if(!empty($category->meta_title)) value="{{$category->meta_title}}" @else value="{{old('meta_title')}}" @endif />
                        <span class="text-danger error-text meta_title_error"></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <input type="text" id="form6Example2" name="meta_keyword" class="form-control" placeholder="Meta Keyowrd" @if(!empty($category->meta_keyword)) value="{{$category->meta_keyword}}" @else value="{{old('meta_keyword')}}" @endif />
                        <span class="text-danger error-text meta_keyword_error"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">

                        <textarea name="meta_description" cols="30" rows="5" class="form-control" placeholder="Meta Description"> @if(!empty($category->meta_description)) {{$category->meta_description}}  @else {{old('meta_description')}} @endif</textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="mb-3 form-check">

                        <input type="checkbox" class="form-check-input" value="1" name="status" {{$category->status == '1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="exampleCheck1">Status</label>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3 form-check">

                        <input type="checkbox" class="form-check-input" value="1" name="popular" {{$category->popular == '1' ? 'checked' : ''}}>
                        <label class="form-check-label" for="exampleCheck1">Popular</label>

                    </div>

                </div>

                <div class="col-md-12 mt-2">
                    <div class="form-group">

                        <input type="file" id="form6Example2" name="category_image" class="form-control-file" />
                        <img src="{{asset('uploads/images/categories/'.$category->category_image)}}" width="100" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if(empty($category->id))
            <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Add Category</button>
            @else
            <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Update Category</button>
            @endif

        </div>
    </form>
</div>








@endsection