<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryAddresses extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','address','city','state','country','pincode','phone','status'];

    public static function deliveryAddresses(){
        $deliveryAddresses = DeliveryAddresses::where('user_id',Auth::user()->id)->get()->toArray();
        // dd($deliveryAddresses);
        return $deliveryAddresses;
    }
}
