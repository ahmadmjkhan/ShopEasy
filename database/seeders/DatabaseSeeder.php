<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Banners::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(BannersTableSeeder::class);
        // $this->call(SectionTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(BrandsTableSeeder::class);
        // $this->call(FilterTableSeeder::class);
        // $this->call(FilterValuesTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(ProductsAttributesTableSeeder::class);
        // $this->call(SellerBanksDetailsTableSeeder::class);
        $this->call(SellerBussinessDetailTableSeeder::class);
    }
}
