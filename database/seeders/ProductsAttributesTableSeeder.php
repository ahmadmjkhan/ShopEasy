<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributesrecords = [
            ['id' => 1, 'product_id' => 2, 'size' => 'large', 'price' => 1100, 'stock' => '12', 'sku' => 'CBR123', 'status' => 1],
            ['id' => 2, 'product_id' => 2, 'size' => 'medium', 'price' => 1200, 'stock' => '22', 'sku' => 'CBR123', 'status' => 1],
            ['id' => 3, 'product_id' => 2, 'size' => 'small', 'price' => 1300, 'stock' => '32', 'sku' => 'CBR123', 'status' => 1]
        ];

        ProductsAttribute::insert($attributesrecords);
    }
}
