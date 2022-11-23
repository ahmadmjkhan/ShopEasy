<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsrecords =

        [
            'id'=>2,'section_id'=>3,'category_id'=>2,'brand_id'=>2,'vendor_id'=>2,'admin_id'=>2,'admin_type'=>'admin','product_name'=>'Galaxy Fold 4','product_color'=>'Red','product_price'=>'45000','product_code'=>'MX1234','product_discount'=>'12','product_weight'=>'180','product_image'=>'','product_video'=>'','short_description'=>'','long_description'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_feature'=>'Yes','status'=>1
        ];

        Products::insert($productsrecords);
    }
}
