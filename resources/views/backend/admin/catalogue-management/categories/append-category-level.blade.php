<div class="form-group">

    <label for="">Select Category Level</label>
    <select name="parent_id" id="parent_id" class="form-control">

        <option value="0" @if(isset($category->parent_id)&& $category->parent_id==0) selected="" @endif> Main Category</option>
        @if(!empty($getcategories))

        @foreach($getcategories as $parentcategory)
        <option value="{{$parentcategory->id}}" @if(isset($category->parent_id) && $category->parent_id == $parentcategory->id) selected="" @endif style="font-weight:700">
            {{$parentcategory->category_name}}</option>

        @if(!empty($parentcategory->subcategories))

        @foreach($parentcategory->subcategories as $subcategory)

        <option value="{{$subcategory->id}}" @if(isset($subcategory->parent_id) && $subcategory->parent_id == $subcategory->id) selected="" @endif>&nbsp;&raquo;&nbsp;<b>{{$subcategory->category_name}}</b></option>

        @endforeach
        @endif

        @endforeach
        @endif
    </select>


</div>