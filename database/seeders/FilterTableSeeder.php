<?php

namespace Database\Seeders;

use App\Models\ProductsFilter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FilterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterrecords = [
            ['id'=>1,'cat_ids'=>'11,12,16','filter_name'=>'Fabric','filter_column'=>'Fabric','status'=>1],
            ['id'=>2,'cat_ids'=>'13,14','filter_name'=>'RAM','filter_column'=>'ram','status'=>1]
        ];

        ProductsFilter::insert($filterrecords);
    }
}
