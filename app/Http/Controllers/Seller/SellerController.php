<?php

namespace App\Http\Controllers\Seller;

use App\Models\Brands;
use App\Models\Seller;
use App\Models\Section;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\ProductsAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

use App\Models\ProductsMultipleImages;
use App\Models\SellersBankDetails;
use App\Models\SellersBussinessDetails;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{

    public function seller_index()
    {
        return view('seller.seller_index');
    }


    public function login_index()
    {
        return view('seller.authentication.login');
    }

    public function register_index()
    {
        return view('seller.authentication.register');
    }

    public function UpdateSellerPassword(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            // echo "<pre>";print_r($data);die;

            if (Hash::check($data['current_password'], Auth::guard('seller')->user()->password)) {

                if ($data['confirm_password'] == $data['new_password']) {

                    $submit = Seller::where('id', Auth::guard('seller')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    if ($submit) {
                        return response()->json([
                            'status' => '1',
                            'message' => 'Password Changed Successfully : Please Wait to Redirect on Seller Dashboard',
                            "redirect_url" => route('seller.home'),
                        ]);
                    }
                    // return redirect()->back()->with('success_message','Password Changed Successfully');
                } else {
                    // return redirect()->back()->with('error_message','Password Not Match');
                    return response()->json([
                        'status' => '0',
                        'message' => 'Password Do not Matched',


                    ]);
                }
            } else {
                return response()->json([
                    'status' => '2',
                    'message' => 'Invalid Current Password !',


                ]);
            }
        }

        $sellerdetail = Seller::where('email', Auth::guard('seller')->user()->email)->first()->toArray();
        return view('seller.authentication.update-seller-password', compact('sellerdetail'));
    }





    public function create(Request $request)
    {

        if ($request->isMethod('post')) {

            $custom_message = [
                'name.required' => 'Full Name is Required',
                'conpassword.same' => 'Password and Confirm Password do not Matched!',
                'unique' => ':attribute is already Exists',
                'conpassword.required' => 'Confirm Password is Required',
                'password.required' => 'Password is Required',
                'phone.required' => 'Mobile is Required',
                'email.required' => 'Email is Required',
            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|unique:sellers',
                'password' => 'required',
                'conpassword' => 'required|same:password',

            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $seller = new Seller();
                $seller->name = $request->name;
                $seller->email = $request->email;
                $seller->phone = $request->phone;
                $seller->password = Hash::make($request->password);

                date_default_timezone_set('Asia/Kolkata');

                $seller->created_at = date("Y-m-d H:i:s");
                $seller->updated_at = date("Y-m-d H:i:s");

                $submit = $seller->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => 'Registration Successful : Please Wait to Redirect on Login Page',
                        "redirect_url" => route('seller.login'),
                    ]);
                }
            }
        }
    }

    public function check(Request $request)
    {
        if ($request->isMethod('post')) {

            $custom_message = [
                'email.exists' => 'Email is not Exists in our Record',

            ];

            $validator = Validator::make($request->all(), [

                'email' => 'required|exists:sellers,email',
                'password' => 'required',


            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $creds = $request->only('email', 'password');
                // dd($creds);

                if (Auth::guard('seller')->attempt($creds)) {
                    return response()->json([
                        'status' => '1',
                        'message' => 'Login Successful : Please Wait to Redirect on Dashboard',
                        "redirect_url" => route('seller.home'),
                    ]);
                } else {
                    return response()->json([
                        'status' => '2',
                        'message' => 'Invalid Email or Password',
                        "redirect_url" => route('seller.login'),
                    ]);
                }
            }
        }
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login');
    }

    public function products_index()
    {
        $seller_id = Auth::guard('seller')->user()->id;
        $products = Products::with(['section' => function ($query) {
            $query->select('id', 'section_name');
        }, 'categories' => function ($query) {
            $query->select('id', 'category_name');
        }])->where('seller_id', $seller_id)->get();


        return view('seller.all-products')->with(compact('products'));
    }

    public function add_edit_Products(Request $request, $id = null)
    {

        if ($id == '') {
            $title = 'Add Product';
            $message = "Product Added Successfully";
            $products = new Products();
        } else {
            $title = "Edit Product";

            $products = Products::find($id);

            $message = "Product Updated Successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            //  echo "<pre>";print_r($data);die;

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


                    $large_image_path = 'uploads/images/products/large/' . $products->product_image;
                    $medium_image_path = 'uploads/images/products/medium/' . $products->product_image;
                    $small_image_path = 'uploads/images/products/small/' . $products->product_image;


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

                        $largeimagepath = 'uploads/images/products/large/' . $filename;
                        $mediumimagepath = 'uploads/images/products/medium/' . $filename;
                        $smallimagepath = 'uploads/images/products/small/' . $filename;



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
                    $product_video = 'uploads/images/products/video/' . $products->product_video;

                    if (File::exists($product_video)) {
                        File::delete($product_video);
                    }

                    $file = $request->file('product_video');

                    if ($file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(111, 99999) . '.' . $extension;
                        $videopath = 'uploads/images/products/video/';
                        $file->move($videopath, $filename);
                        $products->product_video = $filename;
                    }
                }

                $categorydetails = Category::find($request->category_id);

                $products->section_id = $categorydetails->section_id;
                $products->category_id = $request->category_id;
                $products->brand_id = $request->brand_id;


                $productFilters = ProductsFilter::productFilters();
                foreach ($productFilters as $filter) {

                    $filterAvailable = ProductsFilter::filterAvailable($filter->id, $data['category_id']);

                    if ($filterAvailable == "Yes") {

                        if (isset($filter['filter_column']) && $data[$filter['filter_column']]) {
                            $products->{$filter['filter_column']} = $data[$filter['filter_column']];
                        }
                    }
                }




                $seller_id = Auth::guard('seller')->user()->id; // used when product insert by vendor //
                $seller_name = Auth::guard('seller')->user()->name;


                $products->admin_type = $seller_name;
                $products->seller_id = $seller_id;


                $products->product_name = $request->product_name;
                $products->product_code = $request->product_code;
                $products->product_color = $request->product_color;
                $products->product_price = $request->product_price;
                $products->product_discount = $request->product_discount;
                $products->product_weight = $request->product_weight;
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
                        "redirect_url" => route('seller.index'),
                    ]);
                }
            }
        }

        $categories = Section::with('categories')->get();

        $brands = Brands::where('status', 1)->get();

        return view('seller.add-edit-products')->with(compact('title', 'brands', 'categories', 'products'));
    }


    public function delete_product($id)
    {

        $products = Products::find($id);

        if ($products->product_image) {
            $large_image_path = 'uploads/images/products/large/' . $products->product_image;
            $medium_image_path = 'uploads/images/products/medium/' . $products->product_image;
            $small_image_path = 'uploads/images/products/small/' . $products->product_image;


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
            $product_video = 'uploads/images/products/video/' . $products->product_video;

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


    public function AddMultipleImages($id, Request $request)
    {

        $products = Products::select('id', 'product_name', 'product_code', 'product_color', 'product_price', 'product_image')->with('multiple_images')->find($id);

        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($request->hasFile('images')) {

                $file = $request->file('images');

                foreach ($file as $key => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;

                    $largeimagepath = 'uploads/images/products/multiple-images/large/' . $filename;
                    $mediumimagepath = 'uploads/images/products/multiple-images/medium/' . $filename;
                    $smallimagepath = 'uploads/images/products/multiple-images/small/' . $filename;



                    Image::make($image)->resize(1000, 1000)->save($largeimagepath);
                    Image::make($image)->resize(500, 500)->save($mediumimagepath);
                    Image::make($image)->resize(250, 250)->save($smallimagepath);

                    $image = new ProductsMultipleImages();
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
                    "redirect_url" => route('seller.index'),
                ]);
            }
            // return redirect()->back()->with('success_message','Images Added Successfully');
        }

        return view('seller.product-multiple-images.add-edit-mutiple-images')->with(compact('products'));
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

            Products::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }


    public function delete_multiple_images($id)
    {
        $products = ProductsMultipleImages::find($id);

        if ($products->product_image) {
            $large_image_path = 'uploads/images/products/multiple-images/large' . $products->product_image;
            $medium_image_path = 'uploads/images/products/multiple-images/medium' . $products->product_image;
            $small_image_path = 'uploads/images/products/multiple-images/small' . $products->product_image;


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



        $submit = $products->delete();
        if ($submit) {
            return response()->json([
                'status' => '1',
                'message' => 'Image Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Problem Occurs',
            ]);
        }
    }


    public function Add_Edit_Attributes(Request $request, $id)
    {

        $products = Products::select(
            'id',
            'product_name',
            'product_code',
            'product_color',
            'product_price',
            'product_image'
        )->with('attributes')->find($id);

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

                    $attribute = new ProductsAttribute;
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
                    "redirect_url" => route('seller.index'),
                ]);
            }
        }



        return view('seller.products-attributes.add-edit-attributes')->with(compact('products'));
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

            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function editattributes(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['attributeId'] as $key => $attribute) {
                if (!empty($attribute)) {
                    ProductsAttribute::where(['id' => $data['attributeId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message', 'Attribute Updated Successfully');
        }
    }


    public function UpdateSellerDetails(Request $request)
    {


        if ($request->isMethod('post')) {
            $data = $request->all();
            //    echo print_r($data);die;

            Seller::where('id', Auth::guard('seller')->user()->id)->update(['name' => $data['name'], 'email' => $data['email'], 'phone' => $data['phone']]);
            return redirect()->back()->with('success_message', 'Detail Changed Successfully');
        }

        $sellerdetail = Seller::where('email', Auth::guard('seller')->user()->email)->first()->toArray();
        return view('seller.profile.update-seller-details', compact('sellerdetail'));
    }


    public function AddSellerBankDetails(Request $request, $id = null)
    {

        if ($id != '') {
            if ($request->isMethod('post')) {
                $data = $request->all();

                $submit = SellersBankDetails::where('seller_id', Auth::guard('seller')->user()->id)->update(['account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']]);

                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => "Bank Details Updated Successfully",
                        "redirect_url" => route('seller.home'),
                    ]);
                }
            }
        } else {


            $bank = new SellersBankDetails();

            if ($request->isMethod('post')) {

                $validator = Validator::make($request->all(), [
                    'account_holder_name' => 'required',


                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => '0',
                        'error' => $validator->errors()->toArray()
                    ]);
                } else {



                    $seller_id = Auth::guard('seller')->user()->id;

                    $bank->seller_id = $seller_id;
                    $bank->account_holder_name = $request->account_holder_name;
                    $bank->bank_name = $request->bank_name;
                    $bank->account_number = $request->account_number;
                    $bank->bank_ifsc_code = $request->bank_ifsc_code;
                    $submit = $bank->save();
                    if ($submit) {
                        return response()->json([
                            'status' => '1',
                            'message' => "Bank Details Added Successfully",
                            "redirect_url" => route('seller.home'),
                        ]);
                    }
                }
            }
        }
        $bankdetails = SellersBankDetails::where('seller_id', Auth::guard('seller')->user()->id)->first();

        return view('seller.profile.add-edit-seller-bank-details')->with(compact('bankdetails'));
    }


    public function AddSellerBussinessDetails(Request $request, $id = null)
    {

        if ($id != '') {
            if ($request->isMethod('post')) {
                $data = $request->all();

                if ($request->hasfile('address_proof_image')) {
                    $vendor = SellersBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->select('address_proof_image')->first();
                    
                    $path = 'uploads/images/seller-documents/' . $vendor->address_proof_image;
                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $file = $request->file('address_proof_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/images/seller-documents/', $filename);
                    $request->address_proof_image = $filename;
                }

                elseif(!empty($data['address_proof_image'])){
                    $filename = $data['address_proof_image'];
                }else{
                    $filename = "";
                }

                $submit = SellersBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->update(['shop_name' => $data['shop_name'], 'shop_email' => $data['shop_email'], 'shop_mobile' => $data['shop_mobile'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'shop_website' => $data['shop_website'], 'address_proof' => $data['address_proof'], 'address_proof_image' => $filename, 'bussiness_license_number' => $data['bussiness_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number']]);

                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => "Bussiness Details Updated Successfully",
                        "redirect_url" => route('seller.home'),
                    ]);
                }
            }
        } else {


            if ($request->isMethod('post')) {
               
                $validator = Validator::make($request->all(), [
                    'shop_name' => 'required',


                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => '0',
                        'error' => $validator->errors()->toArray()
                    ]);
                } else {

                    $bussiness = new SellersBussinessDetails();

                    if ($request->hasFile('address_proof_image')) {


                        $large_image_path = 'uploads/images/seller-documents/' . $bussiness->address_proof_image;



                        if (File::exists($large_image_path)) {
                            File::delete($large_image_path);
                        }



                        $file = $request->file('address_proof_image');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/images/seller-documents/', $filename);
                        $bussiness->address_proof_image = $filename;

                    }

                    $seller_id = Auth::guard('seller')->user()->id;

                    $bussiness->seller_id = $seller_id;
                    $bussiness->shop_name = $request->shop_name;
                    $bussiness->shop_email = $request->shop_email;
                    $bussiness->shop_mobile = $request->shop_mobile;
                    $bussiness->shop_address = $request->shop_address;

                    $bussiness->shop_city = $request->shop_city;

                    $bussiness->shop_state = $request->shop_state;

                    $bussiness->shop_country = $request->shop_country;

                    $bussiness->shop_pincode = $request->shop_pincode;

                    $bussiness->shop_website = $request->shop_website;

                    $bussiness->address_proof = $request->address_proof;



                    $bussiness->bussiness_license_number = $request->bussiness_license_number;

                    $bussiness->gst_number = $request->gst_number;

                    $bussiness->pan_number = $request->pan_number;


                    $submit = $bussiness->save();
                    if ($submit) {
                        return response()->json([
                            'status' => '1',
                            'message' => "Bussiness Details Added Successfully",
                            "redirect_url" => route('seller.home'),
                        ]);
                    }
                }
            }
        }
        $bussinessdetails = SellersBussinessDetails::where('seller_id', Auth::guard('seller')->user()->id)->first();
        return view('seller.profile.add-edit-seller-bussiness-details')->with(compact('bussinessdetails'));
    }
}
