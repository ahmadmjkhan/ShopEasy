<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    public static function countWishlist($product_id)
    {
        $countWishlist = Wishlist::where(['user_id' => Auth::user()->id, 'product_id' => $product_id])->count();

        return $countWishlist;
    }

    public static function userWishlistItems()
    {
        $userWishlistItems = Wishlist::with(['products' => function ($query) {
            $query->select('id', 'product_name', 'product_color', 'product_image', 'product_price', 'product_code');
        }])->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();

        return $userWishlistItems;
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // public static function wishlistStockCheck($product_id)
    // {
    //     $getProductStock = ProductAttribute::select('stock')->where(['product_id' => $product_id])->first();

    //     return $getProductStock->stock;
    // }
}
