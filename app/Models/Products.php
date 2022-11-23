<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brands(){
        return $this->belongsTo(Brands::class,'brand_id');
    }

    public function sellers(){
        return $this->belongsTo(Seller::class,'seller_id');
    }

   

    public function attributes(){
        return $this->hasMany(ProductsAttribute::class,'product_id');
    }

    public function multiple_images(){
        return $this->hasMany(ProductsMultipleImages::class,'product_id');
    }

    public static function getDiscountPrice($product_id){
        $proDetails = Products::select('product_price','product_discount','category_id')->where('id',$product_id)->first();

        $catDetails = Category::select('category_discount')->where('id',$proDetails->category_id)->first();

        if($proDetails->product_discount>0){
            $discounted_price = $proDetails->product_price - ($proDetails->product_price * $proDetails->product_discount/100);

        }else if($catDetails->category_discount>0){
            $discounted_price = $proDetails->product_price -($proDetails->product_price * $catDetails->category_discount/100);
        }else{
            $discounted_price = 0;
        }

        return $discounted_price;
    }



     // used for change in size to get attribute price //
    public static function getAttributeDiscountPrice($product_id,$size){
        $proAttrPrice = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size])->first();

       
        $proDetails = Products::select('product_discount','category_id')->where('id',$product_id)->first();
        $catDetails = Category::select('category_discount')->where('id',$proDetails->category_id)->first();

        if($proDetails->product_discount>0){
            $final_price = $proAttrPrice->price - ($proAttrPrice->price * $proDetails->product_discount/100);
            $discount = $proAttrPrice->price - $final_price;

        }else if($catDetails->category_discount>0){
            $final_price = $proAttrPrice->price -($proAttrPrice->price * $catDetails->category_discount/100);

            $discount = $proAttrPrice->price - $final_price;

        }else{
            $final_price = $proAttrPrice->price;
            $discount = 0;
        }

        return array('product_price'=>$proAttrPrice->price,'final_price'=>$final_price,'discount'=>$discount);
    }


    public static function isProductNew($product_id){
        $productIds = Products::select('id')->where('status',1)->orderby('id','Desc')->limit(3)->pluck('id');
       
        if(array($product_id,$productIds)){
            $isProductNew = "Yes";
        }else{
            $isProductNew = "No";
        }
        return $isProductNew;
    }
}
