<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    use HasFactory;

    public static function getFilterName($filter_id){
        $getFilterName = ProductFilter::select('filter_name')->where('id',$filter_id)->first();
        return $getFilterName->filter_name;
    }

    public function filter_values()
    {
        return $this->hasMany(ProductFilterValue::class, 'filter_id');
    }

    public static function productFilters()
    {
        $productfilters = ProductFilter::with('filter_values')->where('status', 1)->get();

        return $productfilters;
    }



    public static function filterAvailable($filter_id, $category_id)
    {

        $filterAvailable = ProductFilter::select('cat_ids')->where(['id' => $filter_id, 'status' => 1])->first();



        $catIdsArr = explode(",", $filterAvailable->cat_ids);


        if (in_array($category_id, $catIdsArr)) {
            $available = "Yes";
        } else {
            $available = "No";
        }

        return $available;
    }
}
