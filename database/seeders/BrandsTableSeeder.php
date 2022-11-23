<?php

namespace Database\Seeders;

use App\Models\Brands;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandrecords = ['id'=>'1','brand_name'=>'LG','brand_image'=>'','status'=>1,'popular'=>1];
        ['id'=>'2','brand_name'=>'Samsung','brand_image'=>'','status'=>1,'popular'=>1];
        ['id'=>'3','brand_name'=>'Nokia','brand_image'=>'','status'=>1,'popular'=>1];

        Brands::insert($brandrecords);
    }
}
