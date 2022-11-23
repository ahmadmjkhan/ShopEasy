<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Banners;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {

        $allproducts = Products::with('categories', 'section')->where('status', 1)->get();
        $banners = Banners::where('type', 'Slider')->where('status', 1)->get();
        $fixbanner = Banners::where('status', 'Fix')->where('status', 1)->get();
        $newProducts = Products::with('categories')->orderBy('id', 'Desc')->where('status', 1)->limit(8)->get();

        $bestSellers = Products::where(['is_bestseller' => 'Yes', 'status' => 1])->get();
        $featureProducts = Products::where(['is_feature' => 'Yes', 'status' => 1])->get();
        $discountProducts = Products::where('product_discount', '>', 0)->where('status', 1)->limit(2)->get();

        return view('frontend.index')->with(compact(['allproducts', 'banners', 'fixbanner', 'bestSellers', 'discountProducts', 'newProducts', 'featureProducts']));
    }


    public function quickmodalview($id){

     
        $quick_product = Products::with('categories','multiple_images')->find($id);
        return response()->json($quick_product);
    }

    public function login_page()
    {
        return view('frontend.frontend-login');
    }

    public function register_page()
    {
        return view('frontend.frontend-register');
    }

    public function create(Request $request)
    {

        if ($request->isMethod('post')) {

            $custom_message = [
                'name.required' => 'Name is Required',
                'conpassword.same' => 'Password and Confirm Password do not Matched!',

            ];

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
                'conpassword' => 'required|same:password',

            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                $user = new User();
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $submit = $user->save();
                if ($submit) {
                    return response()->json([
                        'status' => '1',
                        'message' => 'Registration Successful : Please Login to Get Access',
                        "redirect_url" => route('index'),
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

                'email' => 'required|exists:users,email',
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

                if (Auth::guard('web')->attempt($creds)) {
                    return response()->json([
                        'status' => '1',
                        'message' => 'Login Successful : Please Wait to Redirect on Dashboard',
                        "redirect_url" => route('user.home'),
                    ]);
                } else {
                    return response()->json([
                        'status' => '2',
                        'message' => 'Invalid Email or Password',

                    ]);
                }
            }
        }
    }



    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('index');
    }


    public function productlisting(Request $request)
    {

        if ($request->ajax()) {

            $data = $request->all();
            // echo "<pre>";print_r($data);die;


            $url = $data['url'];

            $_GET['sort'] = $data['sort'];

            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);

                $categoryProducts = Products::with('brands')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);




                // $productFilters = ProductsFilter::productFilters();
                // foreach($productFilters as $filter){
                //     if(isset($filter->filter_column)&& isset($data[$filter->filter_column]) && !empty($filter->filter_column) && !empty($data[$filter->filter_column])){
                //         $test = $categoryProducts->whereIn($filter->filter_column,$data[$filter->filter_column]);
                //         echo"<pre>";print_r($test);die;
                //     }
                // }

                // if(isset($data['size']) && !empty($data['size'])){
                //     $productIds = ProductsAttributes::select('product_id')->whereIn('size',$data['size'])->pluck('product_id');
                //     $categoryProducts->whereIn('products.id',$productIds);
                // }



                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == "product-latest") {
                        $categoryProducts->orderBy('products.id', 'Desc');
                    } else if ($_GET['sort'] == "price-lowest") {
                        $categoryProducts->orderBy('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == "price-highest") {
                        $categoryProducts->orderBy('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == "name_a_z") {
                        $categoryProducts->orderBy('products.product_name', 'Asc');
                    } else if ($_GET['sort'] == "name_z_a") {
                        $categoryProducts->orderBy('products.product_price', 'Desc');
                    }
                }

                $categoryProducts = $categoryProducts->paginate(6);

                return view('frontend.ajax-product-listing')->with(compact(['categoryProducts', 'categoryDetails']));
            }
        } else {

            $url = Route::getFacadeRoot()->current()->uri();


            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Products::with('brands')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->paginate(6);


                return view('frontend.product-listing')->with(compact(['categoryProducts', 'categoryDetails', 'url']));
            }
        }
    }

    public function product_details_page($id){

        $productdetails = Products::with(['section','categories','brands','attributes'=>function($query){

            $query->where('stock','>',0)->where('status',1);
        },'multiple_images','sellers'])->find($id);
        // dd($productdetails);
        $relatedproducts = Products::where(['category_id'=>$productdetails->categories->id])->where('id','!=',$id)->limit(6)->inRandomOrder()->get();
        // dd($relatedproducts);
        $totalstock  = ProductsAttribute::where('product_id',$id)->sum('stock');
        return view('frontend.product-detail-page')->with(compact(['productdetails','relatedproducts','totalstock']));
    }



     // used for change in size to get attribute price //
     
    public function getAttributePrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $getDiscountAttributePrice = Products::getAttributeDiscountPrice($data['product_id'],$data['size']);
            return $getDiscountAttributePrice;
        }
    }
}
