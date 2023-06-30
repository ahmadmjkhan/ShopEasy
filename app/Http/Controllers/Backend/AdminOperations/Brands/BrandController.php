<?php

namespace App\Http\Controllers\Backend\AdminOperations\Brands;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function brand_index()
    {
        if (Auth::guard('admin')->check()) {

            $all_brands = Brand::get();
            return view('backend.admin.catalogue-management.brands.brand-index', compact('all_brands'));
        } else {
            redirect()->route('admin.login');
        }
    }

    public function updatebrandstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    public function updatebrandpopular(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['popular'] == 'Active') {
                $popular = 0;
            } else {
                $popular = 1;
            }

            Brand::where('id', $data['brand_id'])->update(['popular' => $popular]);
            return response()->json(['popular' => $popular, 'brand_id' => $data['brand_id']]);
        }
    }


    public function Add_Edit_Brand(Request $request, $id = null)
    {
        if ($id == '') {
            $title = 'Add Brands';
            $brand = new Brand();
            $message = "Brand Added Successfully";
            $getcategories = array();
        } else {
            $title = "Edit Brands";
            $brand = Brand::find($id);

            $message = "Brand Updated Successfully";
        }

        if ($request->isMethod('post')) {



            $validator = Validator::make($request->all(), [
                'brand_name' => 'required',


            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {

                if ($request->hasfile('brand_image')) {
                    $path = 'uploads/catalogue-images/brands/' . $brand->brand_image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('brand_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/catalogue-images/brands/', $filename);
                    $brand->brand_image = $filename;
                }

                $brand->brand_name = $request->brand_name;

                $brand->status = $request->status == TRUE ? '1' : '0';
                $brand->popular = $request->popular == TRUE ? '1' : '0';
                $submit = $brand->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => $message,
                        "redirect_url" => route('admin.brand_index'),
                    ]);
                }
            }
        }




        return view('backend.admin.catalogue-management.brands.add-edit-brand')->with(compact('title', 'brand'));
    }

    public function delete_brand($id)
    {

        $brands = Brand::find($id);

        if ($brands->brand_image) {
            $path = 'uploads/catalogue-images/brands/' . $brands->brand_image;

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $submit = $brands->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Brand Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }

    public function deleteallbrand(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $ids = $data['ids'];
        $brand = explode(",", $ids);


        foreach ($brand as $id) {
            $brands = Brand::find($id);
            // echo "<pre>";print_r($cat);die;

            if ($brands) {
                $brands->delete();

                if ($brands->brand_image) {
                    $path = 'uploads/catalogue-images/brands/' . $brands->brand_image;

                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }
        }
        return response()->json([
            'status' => '1',
            'message' => 'Brand Deleted Successfully',
            "redirect_url" => route('admin.brand_index'),
        ]);
    }


    
}
