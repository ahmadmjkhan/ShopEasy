<?php

namespace App\Http\Controllers\Frontend\FrontendController;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductFilter;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index()
    {


        $allproducts = Product::with('categories', 'section')->where('status', 1)->get();
        $banners = Banner::where('type', 'Slider')->where('status', 1)->get();
        $fixbanner = Banner::where('status', 'Fix')->where('status', 1)->get();
        $newProducts = Product::with('categories')->orderBy('id', 'Desc')->where('status', 1)->limit(8)->get();
        $bestSellers = Product::where(['is_bestseller' => 'Yes', 'status' => 1])->get();
        $featureProducts = Product::where(['is_feature' => 'Yes', 'status' => 1])->get();
        $discountProducts = Product::where('product_discount', '>', 0)->where('status', 1)->limit(2)->get();
        $all_sections = Section::sections();


        return view('frontend.frontend-index')->with(compact(['allproducts', 'banners', 'fixbanner', 'newProducts', 'bestSellers', 'featureProducts', 'discountProducts', 'all_sections']));
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

                $categoryProducts = Product::with('brands')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);


                $productFilters = ProductFilter::productFilters();
                foreach ($productFilters as $key => $filter) {
                    if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($data[$data[$filter['filter_column']]])) {
                        $categoryProducts->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                    }
                }

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

                return view('frontend.product-pages.ajax-product-listing')->with(compact(['categoryProducts', 'categoryDetails']));
            }


        } else {
            $url = Route::getFacadeRoot()->current()->uri();



            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brands')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);


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


                return view('frontend.product-pages.product-listing')->with(compact(['categoryProducts', 'categoryDetails', 'url']));
            }
        }
    }




    public function product_details_page($id)
    {

        $productdetails = Product::with(['section', 'categories', 'brands', 'attributes' => function ($query) {

            $query->where('stock', '>', 0)->where('status', 1);
        }, 'multiple_images', 'sellers'])->find($id);
        // dd($productdetails);
        $relatedproducts = Product::where(['category_id' => $productdetails->categories->id])->where('id', '!=', $id)->limit(6)->inRandomOrder()->get();
        // dd($relatedproducts);
        $totalstock  = ProductAttribute::where('product_id', $id)->sum('stock');
        return view('frontend.product-pages.product-details')->with(compact(['productdetails', 'relatedproducts', 'totalstock']));
    }

    public function checkPincode(Request $request){
      if($request->isMethod('post')){
        $data = $request->all();

        $codPincodeCount = DB::table('cod_pincodes')->where('pincode',$data['pincode'])->count();
        $prepaidPincodeCount = DB::table('prepaid_pincodes')->where('pincode',$data['pincode'])->count();

        if($codPincodeCount==0 && $prepaidPincodeCount==0){
            return response()->json([
                'status'=>0,
                'message' =>"Pincode Is not available for Delivery",
            ]);
        }else{
            return response()->json([
                'status'=>1,
                'message' =>"Pincode Is available for Delivery",
            ]);
        }
      }
    }


    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Session::forget('couponAmount');
            Session::forget('couponCode');
            // echo "<pre>"; print_r($data);die;
            $getCartItems = Cart::getCartItems();
            //  echo "<pre>"; print_r($getCartItems);die;
            $totalCartItems = totalCartItems();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                return response()->json([
                    'status' => 'false',
                    'totalCartItems' => $totalCartItems,
                    'message' => 'The Coupon is not Valid',
                    'view' => (string)View::make('frontend.append-cart-items')->with(compact('getCartItems')),
                    'minicartview' => (string)View::make('frontend.cart-pages.append-mini-cart-items')->with(compact('getCartItems')),
                ]);
            } else {
                // echo "Check for other Condition";

                //Get Coupon Details //
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                //Check if Coupon is Expire //
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    $message = "The Coupon is Expired";
                }

                // check coupon is active //
                if ($couponDetails->status == 0) {
                    $message = "The coupon is not active";
                }

                // Check if Coupon is for single time //
                if ($couponDetails->coupon_type == "Single Times") {
                    $couponCount = Order::where(['coupon_code' => $data['code'], 'user_id' => Auth::user()->id])->count();
                    if ($couponCount >= 1) {
                        $message = "This coupon is already avail by You";
                    }
                }

                //check if coupon is from selected categories //

                //Get all selected categories from coupon and conver to array//
                $catArr = explode(",", $couponDetails->categories);

                //check item not belong to coupon category//
                $total_amount = 0;
                foreach ($getCartItems as $key => $items) {
                    if (!in_array($items['product']['category_id'], $catArr)) {
                        $message = "This coupon is not for YOu this categories products Try with another products";
                    }
                    $attrPrice = Product::getAttributeDiscountPrice($items['product_id'], $items['size']);
                    // echo "<pre>"; print_r($attrPrice);die;
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $items['quantity']);
                    //    echo "<pre>"; print_r($total_amount);die;
                }
                if ($couponDetails->seller_id > 0) {
                    $productIds = Product::select('id')->where('seller_id', $couponDetails->seller_id)->pluck('id')->toArray();
                    //check item not belong to vendor Products//
                    foreach ($getCartItems as $key => $items) {
                        if (!in_array($items['product']['id'], $productIds)) {
                            $message = "This coupon code is not for You,Try with valid coupon_code (Vendor)";
                        }
                    }
                }

                //check if coupon is from selected users //
                // get all selected users from coupon and convert to array //
                if (isset($couponDetails->users) && !empty($couponDetails->users)) {
                    $userArr = explode(',', $couponDetails->users);
                    if (count($userArr)) {
                        // get User id's of all selected users //
                        foreach ($userArr as $key => $user) {
                            $getUserId = User::select('id')->where('email', $user)->first()->toArray();
                            $usersId[] = $getUserId['id'];
                        }
                        //check item not belong to coupon user//
                        foreach ($getCartItems as $items) {

                            if (!in_array($items['user_id'], $usersId)) {
                                $message = "This Coupon is not Valid For You,Try with valid coupon code";
                            }
                        }
                    }
                }


                //if Error message is herer //
                if (isset($message)) {
                    return response()->json([
                        'status' => false,
                        'totalCartItems' => $totalCartItems,
                        'message' => $message,
                        'view' => (string)View::make('frontend.append-cart-items')->with(compact('getCartItems')),
                        'minicartview' => (string)View::make('frontend.cart-pages.append-mini-cart-items')->with(compact('getCartItems')),
                    ]);
                } else {
                    // coupon is correct//

                    //check if Coupon Amount type is fixed or percentage //
                    if ($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                        // echo "<pre>"; print_r($couponAmount);die;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }
                    $grand_total = $total_amount - $couponAmount;
                    //    echo "<pre>"; print_r($grand_total);die;

                    // Add coupon Code & Amount in session variable //
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Coupon Code Successfully Applied.Your are availing Discount";
                    return response()->json([
                        'status' => true,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount' => $couponAmount,
                        'grand_total' => $grand_total,
                        'message' => $message,
                        'view' => (string)View::make('frontend.append-cart-items')->with(compact('getCartItems')),
                        'minicartview' => (string)View::make('frontend.cart-pages.append-mini-cart-items')->with(compact('getCartItems')),
                    ]);
                }
            }
        }
    }

    // used for change in size to get attribute price //

    public function getAttributePrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $getDiscountAttributePrice = Product::getAttributeDiscountPrice($data['product_id'], $data['size']);
            return $getDiscountAttributePrice;
        }
    }
}
