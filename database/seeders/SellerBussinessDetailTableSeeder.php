<?php

namespace Database\Seeders;

use App\Models\SellersBussinessDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerBussinessDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellerbussiness = [
            'id'=>1,'seller_id'=>1,'shop_name'=>'MJ Pvt Ltd','shop_address'=>'Satai Purwa Gonda','shop_city'=>'Gonda','shop_state'=>'UP','shop_country'=>'INDIA','shop_pincode'=>'271002','shop_mobile'=>'78641871','shop_website'=>'Mj.com','shop_email'=>'mj@gmail.com','address_proof'=>'PAN','address_proof_image'=>'','signature_photo'=>'','bussiness_license_number'=>'LIC1234','gst_number'=>'GSTNUM1234567','pan_number'=>'CXIP1233444'
        ];

        SellersBussinessDetails::insert($sellerbussiness);
    }
}
