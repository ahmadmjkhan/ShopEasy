<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    public static function getProductStock($product_id, $size)
    {

        $getProductStock = ProductAttribute::select('stock')->where(['product_id' => $product_id, 'size' => $size])->first();

        return $getProductStock->stock;
    }

    public static function getAttributeStatus($product_id,$size)
    {
        $getAttributeStatus = ProductAttribute::select('status')->where(['product_id'=>$product_id,'size'=>$size])->first();
        return $getAttributeStatus->status;
    }
}