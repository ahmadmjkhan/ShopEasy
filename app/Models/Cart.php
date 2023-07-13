<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public static function getCartItems()
    {
        if (Auth::check()) {
            $getCartItems = Cart::with(['product' => function ($query) {
                $query->select('id', 'category_id', 'product_name', 'product_code', 'product_color', 'product_image', 'product_price','product_weight');
            }])->orderby('id', 'Desc')->where('user_id', Auth::user()->id)->get();
        } else {
            $getCartItems = Cart::with(['product' => function ($query) {
                $query->select('id', 'category_id', 'product_name', 'product_code', 'product_color', 'product_image', 'product_price','product_weight');
            }])->orderby('id', 'Desc')->where('session_id', Session::get('session_id'))->get();
        }
        return $getCartItems;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function userdetails(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
