<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryrecords = [
            'id'=>'1',
            'parent_id'=>'0',
            'section_id'=>'1',
            'category_name'=>'Men',
            'category_image'=>'',
            'category_discount'=>'20',
            'description'=>'good',
            'url'=>'men',
            'meta_title'=>'category',
            'meta_keyword'=>'cate',
            'meta_description'=>'all category',
            'status'=>1,

        ];
        Category::insert($categoryrecords);
    }
}
