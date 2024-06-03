<?php

namespace Database\Seeders;
use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialty::create([
            "name"=>"Website",
            "descriptions"=>" تخصص يهتم في بناء وتطوير المواقع الالكترونية وتطبيقات الويب ولهو اقسام",
            "user_id"=>1
        ]);
        Specialty::create([
            "name"=>"Mobile Application",
            "descriptions"=>"تخصص يهتم في بناء تطبيقات الهواتف الذكية ولهو اقسام",
            "user_id"=>1
        ]);
        Specialty::create([
            "name"=>"Desktop Application",
            "descriptions"=>"تخصص يهتم في بناء تطبيقات سطح المكتب ولهو اقسام",
            "user_id"=>1
        ]);

    }
}
