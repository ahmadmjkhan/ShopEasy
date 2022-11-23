<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsFilterValues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FilterValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filtervaluerecords = [
            ['id'=>1,'filter_id'=>1,'filter_value'=>'Cotton','status'=>1],
            ['id'=>2,'filter_id'=>1,'filter_value'=>'Polyester','status'=>1],
            ['id'=>3,'filter_id'=>2,'filter_value'=>'4GB','status'=>1],
            ['id'=>4,'filter_id'=>2,'filter_value'=>'8GB','status'=>1],
        ];

        ProductsFilterValues::insert($filtervaluerecords);
    }
}
