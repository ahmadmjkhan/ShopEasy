<?php

namespace App\Http\Controllers\Frontend\CartsController;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Models\Product_Ordered;
use App\Models\ProductAttribute;
use App\Models\DeliveryAddresses;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ExchangeRequest;
use App\Models\OrderLog;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // public function add_to_cart_product(Request $request){
    //     $product_id = $request->input('prod_id');
    //     $product_qty = $request->input('prod_qty');

    //     if(Auth::check()){
    //         $prod_check = Product::where('id',$product_id)->first();
    //         if($prod_check){

    //             if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
    //                 return response()->json(['status'=>$prod_check->name."Already Added To cart"]);
    //             }else{
    //                 $cartItem = new Cart;
    //                 $cartItem->prod_id = $product_id;
    //                 $cartItem->user_id = Auth::id();
    //                 $cartItem->prod_qty = $product_qty;
    //                 $cartItem->save();
    //                 return response()->json(['status'=>$prod_check->name."Added To cart"]);
    //             }
    //         }
    //     }else{
    //         return response()->json(['status'=>"Login To Continue"]);
    //      }
    // }

    // Another Way to Add In Cart //

    public function cartAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            Session::forget('couponAmount');
            Session::forget('couponCode');

            $getProductStock = ProductAttribute::getProductStock($data['product_id'], $data['size']);


            if ($getProductStock < $data['quantity']) {
                return redirect()->back()->with('error_message', 'Required Quantity is Not Available');
            }

            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            if (Auth::check()) {

                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => $user_id])->count();
            } else {
                $user_id = 0;
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => $session_id])->count();
            }

            if ($countProducts > 0) {
                return redirect()->back()->with('error_message', 'Product Alread Exists in Cart!');
            }

            $prod_check = Product::where('id', $data['product_id'])->first();
            if ($prod_check) {
                if (Cart::where('product_id', $data['product_id'])->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => '0', 'message' => $prod_check->product_name . " Already Added To cart"]);
                } else {

                    $item = new Cart();
                    $item->session_id = $session_id;
                    $item->user_id = $user_id;
                    $item->product_id = $data['product_id'];
                    $item->size = $data['size'];
                    $item->quantity = $data['quantity'];
                    $item->save();
                    $totalCartItems = totalCartItems();
                    return response()->json(['status' => '1', 'totalCartItem' => $totalCartItems, 'message' => $prod_check->product_name .   ' Added To cart']);
                }
            }
        }
    }

    // public function add_to_cart_product(Request $request){
    //     $product_id = $request->input('prod_id');
    //     $product_qty = $request->input('prod_qty');

    //     if(Auth::check()){
    //         $prod_check = Products::where('id',$product_id)->first();
    //         if($prod_check){

    //             if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
    //                 return response()->json(['status'=>$prod_check->name."Already Added To cart"]);
    //             }else{
    //                 $cartItem = new Cart;
    //                 $cartItem->prod_id = $product_id;
    //                 $cartItem->user_id = Auth::id();
    //                 $cartItem->prod_qty = $product_qty;
    //                 $cartItem->save();
    //                 return response()->json(['status'=>$prod_check->name."Added To cart"]);
    //             }
    //         }
    //     }else{
    //         return response()->json(['status'=>"Login To Continue"]);
    //      }
    // }

    public function shopCartPage()
    {
        if (Auth::check()) {
            Session::forget('couponAmount');
            Session::forget('couponCode');
            $getCartItems = Cart::getCartItems();
            // dd($cartitems);
            $meta_title = "Shopping Cart of ShopEasy Website ";
            $meta_keyword = "Shopping Cart,e-commerce website cart-page";
            $meta_description = "View Shopping cart of E-commerce website";

            return view('frontend.cart-pages.shopping-cart-page')->with(compact('getCartItems', 'meta_title', 'meta_description','meta_keyword'));
        } else {
            return redirect();
        }
    }

    public function delete_item(Request $request)
    {

        if (Auth::check()) {
            Session::forget('couponAmount');
            Session::forget('couponCode');

            $prod_id = $request->input('prod_id');
            if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartitems = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartitems->delete();
                $totalCartItems = totalCartItems();
                return response()->json(['status' => '1', 'totalCartItem' => $totalCartItems, 'message' => 'Product Deleted Suucessfully']);
            }
        } else {
            return response()->json(['status' => "Login To Continue"]);
        }
    }

    public function cart_count()
    {
        $cart = Cart::where('user_id', Auth::id())->count();

        return response()->json(['count' => $cart]);
    }

    // public function cartUpdate(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = $request->all();
    //         // echo "<pre>";print_r($data);die;



    //         // $prod_id = $request->input('prod_id');
    //         // $product_qty = $request->input('prod_qty');

    //         //     if (Auth::check()) {

    //         //         if (Cart::where('product_id', $data['prod_id'])->where('user_id', Auth::id())->exists()) {


    //         //             $cart = Cart::where('product_id', $data['prod_id'])->where('user_id', Auth::id())->first();
    //         //             $cart->quantity = $data['prod_qty'];
    //         //             $cart->update();
    //         //             return response()->json(['status' => '1', 'view' => (string)View::make('frontend.append-cart-items')->with(compact('cartitems'))]);
    //         //             // return response()->json([
    //         //             //     'status'=>'1',
    //         //             //     'message'=>'Quanttity Updated',
    //         //             // ]);
    //         //         }
    //         //     } else {
    //         //         return response()->json(['status' => "Login To Continue"]);
    //         //     }
    //         // }




    //         // $prod_id = $request->input('prod_id');
    //         // $product_qty = $request->input('prod_qty');

    //          $prod_id = $data['prod_id'];
    //         $product_qty = $data['prod_qty'];

    //         if (Auth::check()) {

    //             if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {

    //                 $cart = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
    //                 $cart->quantity = $product_qty;
    //                 $cart->update();
    //                 return response()->json(['status', 'qunatity Updated']);
    //             }
    //         } else {
    //             return response()->json(['status' => "Login To Continue"]);
    //         }
    //     }
    // }

    public function cartUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            Session::forget('couponAmount');
            Session::forget('couponCode');
            $cartDetails = Cart::find($data['cartid']);

            $availableStock = ProductAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first();
            // echo "<pre>"; print_r($availableStock);die;

            if ($data['qty'] > $availableStock['stock']) {
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product Stock is not Available',
                    'view' => (string)View::make('frontend.cart-pages.append-cart-items')->with(compact('getCartItems')),
                ]);
            }


            $availableStock = ProductAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size'], 'status' => 1])->count();

            if ($availableStock == 0) {
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product Size is not Available. please Choose Another Products',
                    'view' => (string)View::make('frontend.cart-pages.append-cart-items')->with(compact('getCartItems')),
                ]);
            }

            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            Session::forget('couponAmount');
            Session::forget('couponCode');
            return response()->json([
                'status' => '1',
                'totalCartItem' => $totalCartItems,
                'view' => (string)View::make('frontend.cart-pages.append-cart-items')->with(compact('getCartItems')),
                'minicartview' => (string)View::make('frontend.cart-pages.append-mini-cart-items')->with(compact('getCartItems')),
            ]);


            // $prod_id = $request->input('prod_id');
            // $product_qty = $request->input('prod_qty');

            //     if (Auth::check()) {

            //         if (Cart::where('product_id', $data['prod_id'])->where('user_id', Auth::id())->exists()) {


            //             $cart = Cart::where('product_id', $data['prod_id'])->where('user_id', Auth::id())->first();
            //             $cart->quantity = $data['prod_qty'];
            //             $cart->update();
            //             return response()->json(['status' => '1', 'view' => (string)View::make('frontend.append-cart-items')->with(compact('cartitems'))]);
            //             // return response()->json([
            //             //     'status'=>'1',
            //             //     'message'=>'Quanttity Updated',
            //             // ]);
            //         }
            //     } else {
            //         return response()->json(['status' => "Login To Continue"]);
            //     }
            // }




            // $prod_id = $request->input('prod_id');
            // $product_qty = $request->input('prod_qty');

            $prod_id = $data['prod_id'];
            $product_qty = $data['prod_qty'];

            if (Auth::check()) {

                if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {

                    $cart = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                    $cart->quantity = $product_qty;
                    $cart->update();
                    return response()->json(['status', 'qunatity Updated']);
                }
            } else {
                return response()->json(['status' => "Login To Continue"]);
            }
        }
    }

    public function checkout_page(Request $request)
    {


        // dd($deliveryAddress);
        $getCartItems = Cart::getCartItems();


        if (count($getCartItems) == 0) {
            $message = "Shopping Cart is Empty Please Add A products";
            return redirect('user/shop-cart')->with('error_message', $message);
        }

        $total_price = 0;
        $total_weight = 0;
        $totalGST = 0;
        foreach ($getCartItems as $item) {
            $getDiscountAttributePrice = Product::getAttributeDiscountPrice($item->product_id, $item->size);
            $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item->quantity);
            $product_weight = $item->product->product_weight;
            $total_weight += $product_weight;

            $product_total_price = $getDiscountAttributePrice['final_price'] * $item->quantity;

            //Calculate GST for Product //
            $getGSTPercent = Product::select('product_gst')->where('id', $item['product_id'])->first();

            $gstPercent = $getGSTPercent->product_gst;
            $gstAmount = round($product_total_price * $gstPercent / 100, 2);
            $totalGST = $totalGST + $gstAmount;
        }



        $deliveryAddresses = DeliveryAddresses::deliveryAddresses();
        foreach ($deliveryAddresses as $key => $value) {
            $shipping_charges = ShippingCharge::getShippingCharges($total_weight, $value['country']);
            // dd($shipping_charges);
            $deliveryAddresses[$key]['shipping_charges'] = $shipping_charges;
            $deliveryAddresses[$key]['gst_charges'] = $totalGST;
            $deliveryAddresses[$key]['codpincodeCount'] = DB::table('cod_pincodes')->where('pincode', $value['pincode'])->count();
            $deliveryAddresses[$key]['prepaidpincodeCount'] = DB::table('prepaid_pincodes')->where('pincode', $value['pincode'])->count();
        }
        // dd($deliveryAddresses);

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;

            //Website Security //
            foreach ($getCartItems as $item) {
                $product_status = Product::getProductStatus($item['product_id']);
                if ($product_status == 0) {
                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of the product is Disabled! please Try Again";
                    return redirect('user/shop-cart')->with('error_message', $message);
                }

                //Prevent Sold Out Products to Order //
                $getProductStock = ProductAttribute::getProductStock($item['product_id'], $item['size']);
                if ($getProductStock == 0) {
                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of the product is sold Out! please Try Again";
                    return redirect('user/shop-cart')->with('error_message', $message);
                }

                //Prevent Disabled Attribute To Order //

                $getAttributeStatus = ProductAttribute::getAttributeStatus($item['product_id'], $item['size']);
                if ($getAttributeStatus == 0) {
                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of the product attribute is disabled! please Try Again";
                    return redirect('user/shop-cart')->with('error_message', $message);
                }
            }
            //website Security End//



            if (empty($data['address_id'])) {
                $message = "Please Select Delivery Address";
                return redirect()->back()->with('error_message', $message);
            }

            //Payment Validation//
            if (empty($data['payment_gateway'])) {
                $message = "Please Select Payment Method";
                return redirect()->back()->with('error_message', $message);
            }

            // Get Delivery Address from address_id//
            $deliveryAddress = DeliveryAddresses::where('id', $data['address_id'])->first()->toArray();
            //  dd($deliveryAddress);

            //Set payment Method as COD if COD is selected from user otherwise as Prepaid //
            if ($data['payment_gateway'] == "COD") {
                $payment_method = "COD";
                $order_status = "New";
            } else {
                $payment_method = "Prepaid";
                $order_status = "Pending";
            }

            DB::beginTransaction();

            // Fetch Order Total Price //
            $total_price = 0;
            foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getAttributeDiscountPrice($item->product_id, $item->size);
                $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item->quantity);
            }

            // Calculate Shipping Charges //
            $shipping_charges = 0;

            //Get ShippingCharges //
            $shipping_charges = ShippingCharge::getShippingCharges($total_weight, $deliveryAddress['country']);

            // dd($shipping_charges);

            //Calculate Grand Total //
            $grand_total = $total_price + $shipping_charges + $totalGST - Session::get('couponAmount');
            // dd($grand_total);

            // Insert Grand Total in Session Variable //
            Session::put('grand_total', $grand_total);

            // Insert Order Details //
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city = $deliveryAddress['city'];
            $order->state = $deliveryAddress['state'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->phone = $deliveryAddress['phone'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = $shipping_charges;
            $order->gst_charges = $totalGST;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = $order_status;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total  = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();

            foreach ($getCartItems as $item) {
                $cartItem = new Product_Ordered();
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'seller_id')->where('id', $item['product_id'])->first()->toArray();
                // dd($getProductDetails);
                $cartItem->admin_id = $getProductDetails['admin_id'];
                $cartItem->seller_id = $getProductDetails['seller_id'];
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $cartItem->product_size = $item['size'];
                $getDiscountAttributePrice = Product::getAttributeDiscountPrice($item['product_id'], $item['size']);
                $cartItem->product_price = $getDiscountAttributePrice['final_price'];
                $cartItem->product_quantity = $item['quantity'];
                $cartItem->save();

                //Reduce Stock Scripts Starts//
                // $getProductStock = ProductAttribute::getProductStock($item['product_id'],$item['size']);
                // $newstock = $getProductStock - $item['quantity'];
                // ProductAttribute::where(['product_id'=>$item['product_id'],'size'=>$item['size']])->update(['stock'=>$newstock]);

            }

            //Insert Order Id in Session Variable //
            Session::put('order_id', $order_id);

            DB::commit();

            $orderDetails = Order::with('order_products')->where('id', $order_id)->first()->toArray();

            if ($data['payment_gateway'] == "COD") {
                //Send Order Email //
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails
                ];

                Mail::send('email-pages.order', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Placed - ShopEasy.com');
                });

                //Reduce Stock Scripts Starts//
                foreach ($orderDetails['order_products'] as $key => $order) {
                    $getProductStock = ProductAttribute::getProductStock($order['product_id'], $order['product_size']);
                    $newstock = $getProductStock - $order['product_quantity'];
                    ProductAttribute::where(['product_id' => $order['product_id'], 'size' => $order['product_size']])->update(['stock' => $newstock]);
                }
            }
            if ($data['payment_gateway'] == 'Paypal') {
                //Paypal-Redirect User to Paypal page after saving order
                return redirect()->route('user.paypal');
            }

            if ($data['payment_gateway'] == 'RazorPay') {
                //Paypal-Redirect User to Paypal page after saving order
                return redirect()->route('user.razorpay');
            }

            return redirect('user/thanks');
        }

        $meta_title = "Checkout page of ShopEasy Website ";
        $meta_keyword = "Checkout page,e-commerce website cart-page";
        $meta_description = "View Checkout page of E-commerce website";


        return view('frontend.cart-pages.checkout-page')->with(compact(['deliveryAddresses', 'getCartItems', 'total_price', 'totalGST','meta_keyword','meta_description','meta_title']));
    }

    // get delivery address //

    public function getDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $deliveryAddresses = DeliveryAddresses::where('id', $data['addressid'])->get()->toArray();
            return response()->json(['address' => $deliveryAddresses]);
        }
    }

    public function saveDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = request()->all();

            $custom_message = [
                'current_password.required' => 'Current Password is Required',


            ];

            $validator = Validator::make($request->all(), [
                'delivery_name' => 'required',
                'delivery_address' => 'required',
                'delivery_city' => 'required',
                'delivery_state' => 'required',
                'delivery_country' => 'required',
                'delivery_pincode' => 'required',
                'delivery_phone' => 'required|digits:10',

            ], $custom_message);

            if ($validator->fails()) {
                return response()->json([
                    'status' => '0',
                    'error' => $validator->errors()->toArray()
                ]);
            } else {
                // echo "<pre>";print_r($data);die;
                $address  = array();
                $address['user_id'] = Auth::user()->id;
                $address['name'] = $data['delivery_name'];
                $address['address'] = $data['delivery_address'];
                $address['city'] = $data['delivery_city'];
                $address['state'] = $data['delivery_state'];
                $address['country'] = $data['delivery_country'];
                $address['pincode'] = $data['delivery_pincode'];
                $address['phone'] = $data['delivery_phone'];
                if (!empty($data['delivery_id'])) {

                    //edit delivery address //
                    DeliveryAddresses::where('id', $data['delivery_id'])->update($address);
                } else {
                    // Add Delivery Address //
                    DeliveryAddresses::create($address);
                }
                $deliveryAddresses = DeliveryAddresses::deliveryAddresses();

                return response()->json([
                    'status' => '1',
                    'view' => (string)View::make('frontend.cart-pages.add-delivery-address')->with(compact('deliveryAddresses'))
                ]);
            }
        }
    }

    public function removeDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            DeliveryAddresses::where('id', $data['addressid'])->delete();
            $deliveryAddresses = DeliveryAddresses::deliveryAddresses();
            return response()->json([
                'view' => (string)View::make('frontend.cart-pages.add-delivery-address')->with(compact('deliveryAddresses')),
            ]);
        }
    }

    public function thanks()
    {
        if (Session::has('order_id')) {
            //Empty The cart //
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('frontend.cart-pages.thanks-page');
        } else {
            return redirect('user/shop-cart');
        }
    }

    public function orders($id = null)
    {
        if (empty($id)) {
            $orders = Order::with('order_products')->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
            // dd($orders);

            return view('frontend.order-pages.my-order-page')->with(compact('orders'));
        } else {
            $orderDetails = Order::with('order_products')->where('id', $id)->first()->toArray();
            //   dd($orderDetails);
            return view('frontend.order-pages.user-order-details-page')->with(compact('orderDetails'));
        }
    }

    public function orderCancel(Request $request, $id)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            if (isset($data['reason']) && empty($data['reason'])) {
                return redirect()->back();
            }
            $user_id_auth = Auth::user()->id;

            $user_id_order = Order::select('user_id')->where('id', $id)->first();

            if ($user_id_auth == $user_id_order->user_id) {
                Order::where('id', $id)->update(['order_status' => 'Cancelled']);

                $log = new OrderLog();
                $log->order_id = $id;
                $log->order_status  = "Cancelled";
                $log->reason = $data['reason'];
                $log->updated_by = "User";
                $log->save();

                $message = "Order Has Been Cancelled";
                return redirect()->back()->with('success_message', $message);
            } else {
                $message = "Your Order Cancellation Request is not Valid";
                return redirect()->back()->with('error_message', $message);
            }
        }
    }


    public function orderReturn(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $user_id_auth = Auth::user()->id;

            $user_id_order = Order::select('user_id')->where('id', $id)->first();
            // echo "<pre>";print_r($data);die;

            if ($user_id_auth == $user_id_order->user_id) {

                if ($data['return_exchange'] == "Return") {
                    //Get Product Details//
                    $productArr = explode("-", $data['product_info']);
                    $product_code = $productArr[0];
                    $product_size = $productArr[1];

                    Product_Ordered::where(['order_id' => $id, 'product_code' => $product_code, 'product_size' => $product_size])->update(['item_status' => 'Return Initiated']);

                    $return = new ReturnRequest();
                    $return->order_id = $id;
                    $return->user_id = $user_id_auth;
                    $return->product_size = $product_size;
                    $return->product_code = $product_code;
                    $return->return_reason = $data['return_reason'];
                    $return->return_status = "Pending";
                    $return->comment = $data['comment'];
                    $return->save();
                    $message = "Return Request has been initiated for the ordered Products";
                    return redirect()->back()->with('success_message', $message);
                } else if ($data['return_exchange'] == "Exchange") {


                    //Get Product Details//
                    $productArr = explode("-", $data['product_info']);
                    $product_code = $productArr[0];
                    $product_size = $productArr[1];

                    Product_Ordered::where(['order_id' => $id, 'product_code' => $product_code, 'product_size' => $product_size])->update(['item_status' => 'Exchange Initiated']);

                    $exchange = new ExchangeRequest();
                    $exchange->order_id = $id;
                    $exchange->user_id = $user_id_auth;
                    $exchange->product_size = $product_size;
                    $exchange->required_size = $data['required_size'];
                    $exchange->product_code = $product_code;
                    $exchange->exchange_reason = $data['return_reason'];
                    $exchange->exchange_status = "Pending";
                    $exchange->comment = $data['comment'];
                    $exchange->save();
                    $message = "Exchange Request has been initiated for the ordered Products";
                    return redirect()->back()->with('success_message', $message);
                } else {
                    $message = "Your Order/Return Request is not Valid";
                    return redirect()->back()->with('error_message', $message);
                }
            } else {
                $message = "Your Order/Return Request is not Valid";
                return redirect()->back()->with('error_message', $message);
            }
        }
    }

    public function getProductSizes(Request $request)
    {
        $data = $request->all();

        // echo "<pre>";print_r($data);die;
        //Get Product Details//
        $productArr = explode("-", $data['product_info']);
        // echo "<pre>";print_r($productArr);die;
        $product_code = $productArr[0];
        $product_size = $productArr[1];

        $productId = Product::select('id')->where('product_code', $product_code)->first();

        $product_id = $productId->id;


        $productSizes = ProductAttribute::select('size')->where('product_id', $product_id)->where('size', '!=', $product_size)->where('stock', '>', 0)->get()->toArray();

        // dd($productSizes);
        $appendSizes = '<option value="">Select Required Size</option>';

        foreach ($productSizes as $size) {
            $appendSizes .= '<option value="' . $size['size'] . '">' . $size['size'] . '</option>';
        }
        return $appendSizes;
    }
}
