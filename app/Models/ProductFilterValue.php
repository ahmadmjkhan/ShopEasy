<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilterValue extends Model
{
    use HasFactory;
    public static function getfiltername($filter_id){
        
        $getFilterName = ProductFilter::select('filter_name')->where('id',$filter_id)->first();
       
        return $getFilterName->filter_name;

    }
}
