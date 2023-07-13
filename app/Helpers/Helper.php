<?php

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function totalCartItems(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $totalCarItems = Cart::where('user_id',$user_id)->sum('quantity');
    }else{
       $session_id = Session::get('session_id');
       $totalCarItems = Cart::where('user_id',$session_id)->sum('quantity');
    }

    return $totalCarItems;
}

 function getCartItems(){
    if(Auth::check()){
        $getCartItems = Cart::with(['product'=>function($query){
            $query->select('id','category_id','product_name','product_code','product_color','product_image','product_price');
        }])->orderby('id','Desc')->where('user_id',Auth::user()->id)->get();
    }else{
        $getCartItems = Cart::with(['product'=>function($query){
            $query->select('id','category_id','product_name','product_code','product_color','product_image','product_price');
        }])->orderby('id','Desc')->where('session_id',Session::get('session_id'))->get();
    }
    return $getCartItems;

}

function totalWishlistItems(){
    if(Auth::check()){
        $user_id = Auth::user()->id;
        $totalWishlistItems = Wishlist::where('user_id',$user_id)->count();
        return $totalWishlistItems;
    }else{
        return false;
    }

    
  

}