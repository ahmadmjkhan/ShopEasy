 @extends('layouts.admin')

 @section('title')
 Add-Edit Section
 @endsection

 @section('content')
 <div class="card shadow">
     <div class="card-header">
         <h4 class="text-center ">{{$title}}</h4>
     </div>
     <form @if(empty($section->id)) action="{{url('admin/add-edit-sections')}}" @else action="{{url('admin/add-edit-sections',$section->id)}}" @endif method="POST" class="form_operation" enctype="multipart/form-data">
         @csrf
         <div class="card-body">
             <div class="alert alert-danger print-error-msg" style="display:none">
                 <ul></ul>
             </div>
             <div class="row mb-4">
                 <div class="col-md-12">
                     <div class="form-group">

                         <input type="text" id="form6Example1" name="section_name" class="form-control" @if(!empty($section->section_name)) value="{{$section->section_name}}" @else value="{{old('section_name')}}" @endif />
                         <span class="text-danger error-text section_name_error"></span>
                     </div>
                 </div>


                 <div class="col-md-12">
                     <div class="mb-3 form-check">

                         <input type="checkbox" class="form-check-input" value="1" name="status" {{$section->status == '1' ? 'checked' : ''}}>
                         <label class="form-check-label" for="exampleCheck1">Status</label>

                     </div>
                 </div>





                 <div class="col-md-12 mt-2">
                     <div class="form-group">
                       
                            
                        
                         <input type="file" id="form6Example2" name="section_image" class="form-control-file" />
                         <img src="{{asset('uploads/images/sections/'.$section->section_image)}}" alt="" width="100">
                         
                     </div>
                 </div>
             </div>
         </div>
         <div class="card-footer">
             <button type="submit" class="btn btn-primary m-auto btn-block mb-4 w-100">Add Section</button>
         </div>
     </form>
 </div>








 @endsection