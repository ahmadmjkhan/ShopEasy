<?php

namespace App\Http\Controllers\Backend\AdminOperations\AdminProducts;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Models\ProductFilter;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\ProductMultipleImages;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    public function product_index()
    {

        $products = Product::with(['section' => function ($query) {
            $query->select('id', 'section_name');
        }, 'categories' => function ($query) {
            $query->select('id', 'category_name');
        }])->get();

        //Set Admin/Subadmin for Category //

        $productModuleCount = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->count();
        if(Auth::guard('admin')->user()->type=='SuperAdmin'){
            $productModule['view_access'] =1;
            $productModule['edit_access'] =1;
            $productModule['full_access'] =1;
        }elseif($productModuleCount==0){
               $message = "This feature is Restricted For You";
               return redirect('admin/dashboard')->with('error_message',$message);
        }else{
            $productModule = AdminRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'module'=>'products'])->first()->toArray();
        }


        return view('backend.admin.product-management.products.product-index')->with(compact(['products','productModule']));
    }

    public function updateproductstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }


    public function Add_Edit_product(Request $request, $id = null)
    {
        if ($id == '') {
            $title = 'Add Product';
            $message = "Product Added Successfully";
            $products = new Product();
        } else {
            $title = "Edit Product";

            $products = Product::find($id);

            $message = "Product Updated Successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();


            $validator = Validator::make($request->all(), [
                'product_name' => 'required',

                'short_description' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {

                if ($request->hasFile('product_image')) {


                    $large_image_path = 'uploads/catalogue-images/products/large/' . $products->product_image;
                    $medium_image_path = 'uploads/catalogue-images/products/medium/' . $products->product_image;
                    $small_image_path = 'uploads/catalogue-images/products/small/' . $products->product_image;


                    if (File::exists($large_image_path)) {
                        File::delete($large_image_path);
                    }

                    if (File::exists($medium_image_path)) {
                        File::delete($medium_image_path);
                    }

                    if (File::exists($small_image_path)) {
                        File::delete($small_image_path);
                    }




                    $file = $request->file('product_image');



                    if ($file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(111, 99999) . '.' . $extension;

                        $largeimagepath = 'uploads/catalogue-images/products/large/' . $filename;
                        $mediumimagepath = 'uploads/catalogue-images/products/medium/' . $filename;
                        $smallimagepath = 'uploads/catalogue-images/products/small/' . $filename;



                        Image::make($file)->resize(1000, 1000)->save($largeimagepath);
                        Image::make($file)->resize(500, 500)->save($mediumimagepath);
                        Image::make($file)->resize(250, 250)->save($smallimagepath);

                        $products->product_image = $filename;
                    }
                    // if (File::exists($largeimagepath,$mediumimagepath,$smallimagepath)) {
                    //     File::delete($largeimagepath,$mediumimagepath,$smallimagepath);
                    // }



                    // $file = $request->file('product_image');

                    // $extension = $file->getClientOriginalExtension();
                    // $filename = time() . '.' . $extension;
                    // $file->move('uploads/images/products/', $filename);
                    // $products->product_image = $filename;
                }

                if ($request->hasFile('product_video')) {
                    $product_video = 'uploads/catalogue-images/products/video/' . $products->product_video;

                    if (File::exists($product_video)) {
                        File::delete($product_video);
                    }

                    $file = $request->file('product_video');

                    if ($file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(111, 99999) . '.' . $extension;
                        $videopath = 'uploads/catalogue-images/products/video/';
                        $file->move($videopath, $filename);
                        $products->product_video = $filename;
                    }
                }

                $categorydetails = Category::find($request->category_id);

                $products->section_id = $categorydetails->section_id;
                $products->category_id = $request->category_id;
                $products->brand_id = $request->brand_id;


                $productFilters = ProductFilter::productFilters();
                foreach ($productFilters as $filter) {

                    $filterAvailable = ProductFilter::filterAvailable($filter->id, $data['category_id']);

                    if ($filterAvailable == "Yes") {

                        if (isset($filter['filter_column']) && $data[$filter['filter_column']]) {
                            $products->{$filter['filter_column']} = $data[$filter['filter_column']];
                        }
                    }
                }



                $adminType = Auth::guard('admin')->user()->type;
                // $seller_id = Auth::guard('seller')->user()->id; // used when product insert by vendor //
                $admin_id = Auth::guard('admin')->user()->id;


                $products->added_by = $adminType;
                $products->admin_id = $admin_id;

                // Used when Products Insert by Vendor //
                // if ($adminType == "vendor") {
                //     $products->vendor_id = $seller_id;
                // } else {
                //     $products->vendor_id = 0;
                // }




                $products->product_name = $request->product_name;
                $products->product_code = $request->product_code;
                $products->product_color = $request->product_color;
                $products->product_price = $request->product_price;
                $products->product_discount = $request->product_discount;
                $products->product_weight = $request->product_weight;
                $products->product_gst = $request->product_gst;
                $products->short_description = $request->short_description;
                $products->long_description = $request->long_description;
                $products->meta_title = $request->meta_title;
                $products->meta_keywords = $request->meta_keywords;
                $products->meta_description = $request->meta_description;
                $products->status = $request->status == TRUE ? '1' : '0';
                $products->is_feature = $request->is_feature == TRUE ? 'Yes' : 'No';
                $products->is_bestseller = $request->is_bestseller == TRUE ? 'Yes' : 'No';
                $submit = $products->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => $message,
                        "redirect_url" => route('admin.product_index'),
                    ]);
                }
            }
        }

        $categories = Section::with('categories')->get();

        $brands = Brand::where('status', 1)->get();

        return view('backend.admin.product-management.products.add-edit-product')->with(compact('title', 'brands', 'categories', 'products'));
    }

    public function delete_product($id)
    {

        $products = Product::find($id);

        if ($products->product_image) {
            $large_image_path = 'uploads/catalogue-images/products/large/' . $products->product_image;
            $medium_image_path = 'uploads/catalogue-images/products/medium/' . $products->product_image;
            $small_image_path = 'uploads/catalogue-images/products/small/' . $products->product_image;


            if (File::exists($large_image_path)) {
                File::delete($large_image_path);
            }

            if (File::exists($medium_image_path)) {
                File::delete($medium_image_path);
            }

            if (File::exists($small_image_path)) {
                File::delete($small_image_path);
            }
        }

        if ($products->product_video) {
            $product_video = 'uploads/catalogue-images/products/video/' . $products->product_video;

            if (File::exists($product_video)) {
                File::delete($product_video);
            }
        }

        $submit = $products->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Products Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }



    public function deleteallproducts(Request $request)
    {
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $ids = $data['ids'];
        $product = explode(",", $ids);


        foreach ($product as $id) {
            $products = Product::find($id);
            // echo "<pre>";print_r($cat);die;

            if ($products) {
                $products->delete();

                if ($products->product_image) {
                    $large_image_path = 'uploads/catalogue-images/products/large/' . $products->product_image;
                    $medium_image_path = 'uploads/catalogue-images/products/medium/' . $products->product_image;
                    $small_image_path = 'uploads/catalogue-images/products/small/' . $products->product_image;


                    if (File::exists($large_image_path)) {
                        File::delete($large_image_path);
                    }

                    if (File::exists($medium_image_path)) {
                        File::delete($medium_image_path);
                    }

                    if (File::exists($small_image_path)) {
                        File::delete($small_image_path);
                    }
                }
            }

            if ($products->product_video) {
                $product_video = 'uploads/catalogue-images/products/video/' . $products->product_video;

                if (File::exists($product_video)) {
                    File::delete($product_video);
                }
            }
        }
        return response()->json([
            'status' => '1',
            'message' => 'Products Deleted Successfully',
            "redirect_url" => route('admin.product_index'),
        ]);
    }




    public function Add_Edit_Attributes(Request $request, $id)
    {


        $products = Product::select(
            'id',
            'product_name',
            'product_code',
            'product_color',
            'product_price',
            'product_image'
        )->with('attributes')->find($id);

        // echo "<pre>";print_r($products->product_image);die;

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            foreach ($data['sku'] as $key => $value) {

                if (!empty($value)) {

                    //For Already Exists SKU AND SIZE //
                    // $skuCount = ProductsAttributes::where('sku',$value)->count();
                    // if($skuCount>0){
                    //     return redirect()->back()->with('error_message','SKU already Exists Please Add Another Sku');

                    // }

                    // $sizeCount = ProductsAttributes::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();

                    // if($sizeCount>0){
                    //     return redirect()->back()->with('error_message','Size already Exists Please Add Another Size');
                    // }

                    //For Already Exists SKU AND SIZE //

                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $submit = $attribute->save();
                }
            }
            if ($submit) {
                return response()->json([
                    'status' => '1',
                    'message' => 'Attribute Added Succesfully',
                    "redirect_url" => route('admin.product_index'),
                ]);
            }
        }



        return view('backend.admin.product-management.products-attributes.add-edit-attributes')->with(compact('products'));
    }

    public function updateattributestatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function editattributes(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['attributeId'] as $key => $attribute) {
                if (!empty($attribute)) {
                    ProductAttribute::where(['id' => $data['attributeId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message', 'Attribute Updated Successfully');
        }
    }


    public function delete_attribute($id)
    {

        $attribute = ProductAttribute::find($id);



        $submit = $attribute->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Attribute Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }



    public function AddMultipleImages($id, Request $request)
    {

        $products = Product::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_image')->with('multiple_images')->find($id);

        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($request->hasFile('images')) {

                $file = $request->file('images');

                foreach ($file as $key => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;

                    $largeimagepath = 'uploads/catalogue-images/products/multiple-images/large/' . $filename;
                    $mediumimagepath = 'uploads/catalogue-images/products/multiple-images/medium/' . $filename;
                    $smallimagepath = 'uploads/catalogue-images/products/multiple-images/small/' . $filename;



                    Image::make($image)->resize(1000, 1000)->save($largeimagepath);
                    Image::make($image)->resize(500, 500)->save($mediumimagepath);
                    Image::make($image)->resize(250, 250)->save($smallimagepath);

                    $image = new ProductMultipleImages();
                    $image->images = $filename;
                    $image->product_id = $id;
                    $image->status = 1;
                    $submit = $image->save();
                }
            }

            if ($submit) {
                return response()->json([
                    'status' => '1',
                    'message' => 'Images Added Succesfully',
                    "redirect_url" => route('admin.product_index'),
                ]);
            }
            // return redirect()->back()->with('success_message','Images Added Successfully');
        }

        return view('backend.admin.product-management.product-multiple-images.add-edit-mutiple-images')->with(compact('products'));
    }

    public function updatemultipleimagesstatus(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }


    public function delete_multiple_images($id)
    {

        $multiple_images = ProductMultipleImages::find($id);

        if ($multiple_images->images) {
            $largeimagepath = 'uploads/catalogue-images/products/multiple-images/large/' . $multiple_images->images;
            $mediumimagepath = 'uploads/catalogue-images/products/multiple-images/medium/' . $multiple_images->images;
            $smallimagepath = 'uploads/catalogue-images/products/multiple-images/small/' . $multiple_images->images;


            if (File::exists($largeimagepath)) {
                File::delete($largeimagepath);
            }

            if (File::exists($mediumimagepath)) {
                File::delete($mediumimagepath);
            }

            if (File::exists($smallimagepath)) {
                File::delete($smallimagepath);
            }
        }


        $submit = $multiple_images->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Images Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }
}
