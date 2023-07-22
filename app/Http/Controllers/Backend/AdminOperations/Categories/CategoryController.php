<?php

namespace App\Http\Controllers\Backend\AdminOperations\Categories;

use App\Models\Section;
use App\Models\Category;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function category_index()
    {
       

            $category = Category::with(['section', 'parentcategory'])->get();

            //Set Admin/Subadmin for Category //

            $categoryModuleCount = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->count();
            if(Auth::guard('admin')->user()->type=='SuperAdmin'){
                $categoryModule['view_access'] =1;
                $categoryModule['edit_access'] =1;
                $categoryModule['full_access'] =1;
            }elseif($categoryModuleCount==0){
                   $message = "This feature is Restricted For You";
                   return redirect('admin/dashboard')->with('error_message',$message);
            }else{
                $categoryModule = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'categories'])->first()->toArray();
            }

            return view('backend.admin.catalogue-management.categories.category-index')->with(compact(['category','categoryModule']));
       
    }


    public function updatecategorystatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function updatecategorypopular(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);

            if ($data['popular'] == 'Active') {
                $popular = 0;
            } else {
                $popular = 1;
            }

            Category::where('id', $data['category_id'])->update(['popular' => $popular]);
            return response()->json(['popular' => $popular, 'category_id' => $data['category_id']]);
        }
    }




    public function Add_Edit_Categories(Request $request, $id = null)
    {
        if ($id == '') {
            $title = 'Add Category';
            $message = "Category Added Successfully";
            $category = new Category();

            $getcategories = array();
        } else {
            $title = "Edit Category";

            $category = Category::find($id);
            $getcategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $category->section_id])->get();

            $message = "Category Updated Successfully";
        }

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'category_name' => 'required',

                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {

                if ($request->hasFile('category_image')) {
                    $path = 'uploads/catalogue-images/categories/' . $category->category_image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('category_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/catalogue-images/categories/', $filename);
                    $category->category_image = $filename;
                }

                $category->category_name = $request->category_name;
                $category->section_id = $request->section_id;
                $category->parent_id = $request->parent_id;
                $category->description = $request->description;
                $category->category_discount = $request->category_discount;
                $category->url = $request->url;
                $category->meta_title = $request->meta_title;
                $category->meta_keyword = $request->meta_keyword;
                $category->meta_description = $request->meta_description;
                $category->status = $request->status == TRUE ? '1' : '0';
                $category->popular = $request->popular == TRUE ? '1' : '0';
                $submit = $category->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => $message,
                        "redirect_url" => route('admin.category_index'),
                    ]);
                }
            }
        }

        $getsection = Section::get();


        return view('backend.admin.catalogue-management.categories.add-edit-category')->with(compact('title', 'getsection', 'category', 'getcategories'));
    }


    public function delete_category($id)
    {

        $category = Category::find($id);

        if ($category->category_image) {
            $path = 'uploads/catalogue-images/categories/' . $category->category_image;

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $submit = $category->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Category Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }


    public function deleteallcategories(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $ids = $data['ids'];
        $category = explode(",", $ids);


        foreach ($category as $id) {
            $cat = Category::find($id);
            // echo "<pre>";print_r($cat);die;

            if ($cat) {
                $cat->delete();

                if ($cat->category_image) {
                    $path = 'uploads/catalogue-images/categories/' . $cat->category_image;

                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }
        }
        return response()->json([
            'status' => '1',
            'message' => 'Category Deleted Successfully',
            "redirect_url" => route('admin.category_index'),
        ]);


        //    DB::table('brands')->whereIn('id',explode(",",$ids))->delete();

        // Category::whereIn('id', explode(",", $ids))->delete();
    }

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getcategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $data['section_id']])->get();

            // $getcategories = json_decode(json_encode($getcategories)); 
            return view('backend.admin.catalogue-management.categories.append-category-level')->with(compact('getcategories'));
        }
    }
}
