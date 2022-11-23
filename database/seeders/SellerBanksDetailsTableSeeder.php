<?php

namespace Database\Seeders;

use App\Models\SellersBankDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerBanksDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellerbank = [
            'id'=>1,'seller_id'=>1,'account_holder_name'=>'Nadeem Khan','bank_name'=>'Punjab National Bank','account_number'=>'12356666667','bank_ifsc_code'=>'PUNB186400'
        ];

        SellersBankDetails::insert($sellerbank);
    }
}
