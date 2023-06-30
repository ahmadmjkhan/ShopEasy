<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function seller_coupon(){
        return $this->belongsTo(Seller::class,'seller_id');
    }

    public static function couponDetails($coupon_code){
        $couponDetails = Coupon::where('coupon_code',$coupon_code)->first()->toArray();

        return $couponDetails;
    }
}
