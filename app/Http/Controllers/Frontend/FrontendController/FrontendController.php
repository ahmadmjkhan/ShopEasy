<?php

namespace App\Http\Controllers\Frontend\FrontendController;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use App\Models\Wishlist;
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
        // $all_laptops = Product::with('categories')->where(['category_id'=>'72'])->get();

        $discountProducts = Product::where('product_discount', '>', 0)->where('status', 1)->limit(2)->get();
        $all_sections = Section::sections();

        $meta_title = "ShopEasy a E-commerce Website,Shopping like a Freedom";
        $meta_keywords = "ShopeEasy,Clothing and Fashion,ELectronics And Appliances,Mobiles,Gadgets";
        $meta_description = "ShopeEasy is a E-commerce website where you can buy and Sell product easily";
        return view('frontend.frontend-index')->with(compact(['allproducts', 'banners', 'fixbanner', 'newProducts', 'bestSellers', 'featureProducts', 'discountProducts', 'all_sections', 'meta_title', 'meta_description', 'meta_keywords']));
    }


    // public function productlistingAjax(){
    //     $products = Product::select('product_name')->where('status',1)->get();
    //     $data = [];

    //     foreach($products as $item){
    //         $data[] = $item['product_name'];
    //     }

    //     return $data;
    // }




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
                

                $categoryProducts = Product::with('brands','multiple_images')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);


                //Checking for Dynamic Filtres//
                $productFilters = ProductFilter::productFilters();
                foreach ($productFilters as $key => $filter) {
                    if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                        $categoryProducts->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                    }
                }

                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == "product-latest") {
                        $categoryProducts->orderBy('products.id', 'Desc');
                    } else if ($_GET['sort'] == "price-lowest") {
                        $categoryProducts->orderBy('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == "price-highest") {
                        $categoryProducts->orderBy('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == "name_a_z") {
                        $categoryProducts->orderBy('products.product_name', 'Asc');
                    } else if ($_GET['sort'] == "name_z_a") {
                        $categoryProducts->orderBy('products.product_price', 'Desc');
                    }
                }

                //Chceking for size filters//
                if(isset($data['size']) && !empty($data['size'])) {

                    $productIds = ProductAttribute::select('product_id')->whereIn('size',$data['size'])->pluck('product_id')->toArray();
                    $categoryProducts->whereIn('products.id',$productIds);
                }

                //Checking for color filters//
                if(isset($data['color']) && !empty($data['color'])) {

                    $productIds = Product::select('id')->whereIn('product_color',$data['color'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id',$productIds);
                }


                //Checking for price range filters//
                
                // if(isset($data['price']) && !empty($data['price'])) {

                //     foreach($data['price'] as $key => $price){
                //         $priceArr = explode("-", $price);
                //         $productIds[] = Product::select('id')->whereBetween('product_price',[$priceArr[0],$priceArr[1]])->pluck('id')->toArray();

                    
                            
                //     }
                //     $productIds = call_user_func_array('array_merge', $productIds);
                    
                //     $categoryProducts->whereIn('products.id',$productIds);
                // }

                //Checking for brand filters//
                if(isset($data['brand']) && !empty($data['brand'])) {

                    $productIds = Product::select('id')->whereIn('brand_id',$data['brand'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id',$productIds);
                }



                $categoryProducts = $categoryProducts->paginate(6);
                // dd($categoryProducts);

                $meta_title = $categoryDetails['categoryDetails']['meta_title'];
                $meta_keyword = $categoryDetails['categoryDetails']['meta_keyword'];
                $meta_description = $categoryDetails['categoryDetails']['meta_description'];

                return view('frontend.product-pages.ajax-product-listing')->with(compact(['categoryProducts', 'categoryDetails', 'meta_title', 'meta_description', 'meta_keyword']));
            }
        } else {
           
            // Search for products//
            if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
                $search_product = $_REQUEST['search'];
                $categoryDetails['breadcrumb'] = $search_product;
                $categoryDetails['categoryDetails']['category_name'] = $search_product;
                $categoryDetails['categoryDetails']['description'] = "Search Results for " . $search_product;

                
                $categoryProducts = Product::select('products.id', 'products.category_id', 'products.section_id', 'products.brand_id', 'products.product_image', 'products.seller_id', 'products.product_name', 'products.product_code', 'products.product_color', 'products.product_price', 'products.product_discount', 'products.short_description')->with('brands')->join('categories', 'categories.id', '=', 'products.category_id')->where(function ($query) use ($search_product) {

                    $query->where('products.product_name', 'like', '%' . $search_product . '%')
                        ->orwhere('products.product_code', 'like', '%' . $search_product . '%')
                        ->orwhere('products.short_description', 'like', '%' . $search_product . '%')
                        ->orwhere('products.product_color', 'like', '%' . $search_product . '%')
                        ->orwhere('categories.category_name', 'like', '%' . $search_product . '%');
                })->where('products.status', 1);

                if (isset($_REQUEST['section_id']) && !empty($_REQUEST['section_id'])) {
                    $categoryProducts = $categoryProducts->where('products.section_id', $_REQUEST['section_id']);
                }

                $categoryProducts = $categoryProducts->get();
               
                // dd($categoryProducts);
                return view('frontend.product-pages.product-listing')->with(compact(['categoryProducts', 'categoryDetails']));
            } else {


                $url = Route::getFacadeRoot()->current()->uri();
                $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
                if ($categoryCount > 0) {
                    $categoryDetails = Category::categoryDetails($url);
                    $categoryProducts = Product::with('brands')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                    //Sort Products by //
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
                    $meta_title = $categoryDetails['categoryDetails']['meta_title'];
                    $meta_keyword = $categoryDetails['categoryDetails']['meta_keyword'];
                    $meta_description = $categoryDetails['categoryDetails']['meta_description'];
                    return view('frontend.product-pages.product-listing')->with(compact(['categoryProducts', 'categoryDetails', 'url', 'meta_title', 'meta_description', 'meta_keyword']));
                }
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

        //Get All Rating Products//
        $ratings = Rating::with('user')->where('status', 1)->where('product_id', $id)->get()->toArray();

        //Get Avg Rating for the Product//
        $ratingSum = Rating::where('status', 1)->where('product_id', $id)->sum('rating');
        $ratingCount = Rating::where('status', 1)->where('product_id', $id)->count();

        if ($ratingCount > 0) {
            $avgRating = round($ratingSum / $ratingCount, 2);
            $avgStarRating = round($ratingSum / $ratingCount);
        } else {
            $avgRating = 0;
            $avgStarRating = 0;
        }

        $meta_title = $productdetails['product_name'];
        $meta_keyword = $productdetails['meta_keywords'];
        $meta_description = $productdetails['meta_description'];

        return view('frontend.product-pages.product-details')->with(compact(['productdetails', 'relatedproducts', 'totalstock', 'ratings', 'avgRating', 'avgStarRating', 'meta_title', 'meta_description', 'meta_keyword']));
    }

    public function checkPincode(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $codPincodeCount = DB::table('cod_pincodes')->where('pincode', $data['pincode'])->count();
            $prepaidPincodeCount = DB::table('prepaid_pincodes')->where('pincode', $data['pincode'])->count();

            if ($codPincodeCount == 0 && $prepaidPincodeCount == 0) {
                return response()->json([
                    'status' => 0,
                    'message' => "Pincode Is not available for Delivery",
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'message' => "Pincode Is available for Delivery",
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


    public function wishlist()
    {
        $userWishlistItems = Wishlist::userWishlistItems();




        return view('frontend.wishlist-pages.wishlist-page')->with(compact('userWishlistItems'));
    }

    public function updateWishlist(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);

            $countWishlist = Wishlist::countWishlist($data['product_id']);
            if ($countWishlist == 0) {
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $data['product_id'];
                $wishlist->save();
                $totalWishlistItems = totalWishlistItems();
                return response()->json([
                    'totalWishlistItems' => $totalWishlistItems,
                    'status' => true,
                    'action' => 'Added'
                ]);
            } else {

                Wishlist::where(['user_id' => Auth::user()->id, 'product_id' => $data['product_id']])->delete();
                $totalWishlistItems = totalWishlistItems();
                return response()->json([
                    'totalWishlistItems' => $totalWishlistItems,
                    'status' => true,
                    'action' => "Remove"
                ]);
            }
        }
    }

    public function deleteWishlistItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            Wishlist::where('id', $data['wishlistid'])->delete();

            $userWishlistItems = Wishlist::userWishlistItems();
            $totalWishlistItems = totalWishlistItems();
            return response()->json([
                'totalWishlistItems' => $totalWishlistItems,
                'view' => (string)View::make('frontend.wishlist-pages.append-wishlist-page')->with(compact('userWishlistItems')),

            ]);
        }
    }

    public function addRating(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            if (!Auth::check()) {
                $message = "Login To Rate this Product";
                return redirect()->back()->with('error_message', $message);
            }

            if (!isset($data['rating'])) {
                $message = "Add Atleast one rating for this Product";
                return redirect()->back()->with('error_message', $message);
            }

            $ratingCount = Rating::where(['user_id' => Auth::user()->id, 'product_id' => $data['product_id']])->count();

            if ($ratingCount > 0) {
                $message = "Your rating alrady exist for this product";
                return redirect()->back()->with('error_message', $message);
            } else {
                $rating = new Rating();
                $rating->user_id = Auth::user()->id;
                $rating->product_id = $data['product_id'];
                $rating->reviews = $data['reviews'];
                $rating->rating = $data['rating'];
                $rating->status = 0;
                $rating->save();
                $message = "Thanks for Rating this Product! It Will be shown once Approved";
                return redirect()->back()->with('success_message', $message);
            }
        }
    }
}
