<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionrecords = ['id'=>'1','section_name'=>'Clothing','status'=>1];
        ['id'=>'2','section_name'=>'Electronics','status'=>1];

        Section::insert($sectionrecords);
    }
}
