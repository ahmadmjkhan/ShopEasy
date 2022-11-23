<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

use Laravel\Ui\Presets\React;
use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\String_;

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

            $getProductStock = ProductsAttribute::getProductStock($data['product_id'], $data['size']);


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

            $prod_check = Products::where('id', $data['product_id'])->first();
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
                    return response()->json(['status' => '1', 'message' => $prod_check->product_name .   ' Added To cart']);
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

        $getCartItems = Cart::getCartItems();
        // dd($cartitems);


        return view('frontend.shopping-cart-page')->with(compact('getCartItems'));
    }

    public function delete_item(Request $request)
    {

        if (Auth::check()) {

            $prod_id = $request->input('prod_id');
            if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartitems = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartitems->delete();
                return response()->json(['status' => '1', 'message' => 'Product Deleted Suucessfully']);
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

            $cartDetails = Cart::find($data['cartid']);

            $availableStock = ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->first();
            // echo "<pre>"; print_r($availableStock);die;

            if($data['qty']>$availableStock['stock']){
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'Product Stock is not Available',
                    'view'=>(String)View::make('frontend.append-cart-items')->with(compact('getCartItems')),
                ]);
            }


            $availableStock = ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=>1])->count();

            if($availableStock==0){
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'Product Size is not Available. please Choose Another Products',
                    'view'=>(String)View::make('frontend.append-cart-items')->with(compact('getCartItems')),
                ]);
            }

            Cart::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
            $getCartItems = Cart::getCartItems();
            return response()->json([
                'status'=>'1',
                'view'=>(String)View::make('frontend.append-cart-items')->with(compact('getCartItems')),
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
}
