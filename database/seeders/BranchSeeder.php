<?php

namespace Database\Seeders;
use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            "name"=>"front-end",
            "descriptions"=>"يهتم هذا الفرع بتصميم الواجهات الامامية لمواقع الانترنت ",
            "user_id"=>1,
            "sp_id"=>1,//website

        ]);
        Branch::create([
            "name"=>"back-end",
            "descriptions"=>"يهتم هذا الفرع بالتعامل مع الخادم او السيرفر و التعامل مع قواعد البيانات و اجراء العمليات على البيانات",
            "user_id"=>1,
            "sp_id"=>1//website
        ]);
        Branch::create([
            "name"=>"IOS",
            "descriptions"=>"يهتم هذا الفرع بنشاء وتطوير تطبيقات الهواتف التي تعمل بنظام (IOS)",
            "user_id"=>1,
            "sp_id"=>2//mobile
        ]);
        Branch::create([
            "name"=>"Android",
            "descriptions"=>"يهتم هذا الفرع بنشاء وتطوير تطبيقات الهواتف التي تعمل بنظام (Android)",
            "user_id"=>1,
            "sp_id"=>2//mobile
        ]);

        Branch::create([
            "name"=>"Desktop Application",
            "descriptions"=>"يهتم هذا الفرع بنشاء وتطوير تطبيقات سطح المكتب ",
            "user_id"=>1,
            "sp_id"=>3//Desktop
        ]);
    }
}
