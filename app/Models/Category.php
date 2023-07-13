<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'section_id', 'category_name', 'category_image', 'category_discount', 'description', 'url', 'meta_title', 'meta_keyword', 'meta_description', 'status'];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id')->select('id', 'section_name');
    }

    public function parentcategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'category_name');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }


    public static function categoryDetails($url)
    {
     


        $categoryDetails = Category::select('id', 'parent_id', 'category_name', 'url','description','meta_title','meta_keyword','meta_description')->with(['subcategories' => function ($query) {
            $query->select('id', 'parent_id', 'category_name', 'url','description','meta_title','meta_keyword','meta_description');
        }])->where('url', $url)->first()->toArray();



        $catIds = array();
        $catIds[] = $categoryDetails['id'];


        if ($categoryDetails['parent_id'] == 0) {

            $breadcrumb = '<li class="breadcrumb-item active"><a href="' . url($categoryDetails['url']) . '">' . $categoryDetails['category_name'] . '</a></li>';
        } else {

            $parentcategory = Category::select('category_name', 'url','meta_title','meta_keyword','meta_description')->where('id', $categoryDetails['parent_id'])->first()->toArray();
            $breadcrumb = '<li class="breadcrumb-item active"><a href="' . url($parentcategory['url']) . '">' . $parentcategory['category_name'] . '</a></li>';
            $breadcrumb = '<li class="breadcrumb-item active"><a href="' . url($categoryDetails['url']) . '">' . $categoryDetails['category_name'] . '</a></li>';
        }


        foreach ($categoryDetails['subcategories'] as $key => $subcat) {
            $catIds[] = $subcat['id'];
        }

        $resp = array('catIds' => $catIds, 'categoryDetails' => $categoryDetails, 'breadcrumb' => $breadcrumb);
        return $resp;
    }

    public static function getcategoryname($category_id)
    {
        $getCategoryName = Category::select('category_name')->where('id', $category_id)->first();
        // dd($getCategoryName);
        return $getCategoryName->category_name;
    }
}
