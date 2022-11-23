<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{

    public function category_index()
    {
        if (Auth::guard('admin')->check()) {

            $category = Category::with(['section','parentcategory'])->get();

            
           
            return view('admin.categories.category-index')->with(compact('category'));
        } else {
            redirect()->route('admin.login');
        }
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
            $getcategories = Category::with('subcategories')->where(['parent_id' =>0, 'section_id' => $category->section_id])->get();

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
                    $path = 'uploads/images/categories/' . $category->category_image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('category_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/images/categories/', $filename);
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
                        "redirect_url"=>route('admin.category_index'),
                    ]);
                }
            }
        }

        $getsection = Section::get();
       

        return view('admin.categories.add-edit-categories')->with(compact('title', 'getsection','category','getcategories'));
    }


    public function delete_category($id)
    {

        $category = Category::find($id);

        if ($category->category_image) {
            $path = 'uploads/images/categories/' . $category->category_image;

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

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getcategories = Category::with('subcategories')->where(['parent_id' =>0, 'section_id'=> $data['section_id']])->get();
        
            // $getcategories = json_decode(json_encode($getcategories)); 
            return view('admin.categories.append-category-level')->with(compact('getcategories'));
        }
    }
}
