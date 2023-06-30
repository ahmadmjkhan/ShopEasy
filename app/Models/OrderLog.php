<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    public function order_products()
    {
        return $this->hasMany(Product_Ordered::class, 'id','order_item_id');
    }

    public static function getItemDetails($order_item_id){
        $getItemDetails = Product_Ordered::where('id',$order_item_id)->first()->toArray();
        return $getItemDetails;
    }
}
