<?php

namespace Database\Seeders;

use App\Models\Banners;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannersrecords = [['id'=>1,'type'=>'Slider','banner_image'=>'','link'=>'Images','title'=>'images','alt'=>'image','status'=>1],
        ['id'=>2,'type'=>'Fix','banner_image'=>'','link'=>'Images','title'=>'images','alt'=>'image','status'=>1],];

        Banners::insert($bannersrecords);
    }
}
