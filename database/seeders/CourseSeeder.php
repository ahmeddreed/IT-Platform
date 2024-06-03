<?php

namespace Database\Seeders;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::insert([
            "user_id"=>1,
            'name'=> "php",
            "title"=>"برمجة مواقع",
            'description'=> "برمجة المواقع الالكترونية",
            'br_id' => 2,
            'lg_id'=> 5,
            'state'=>"normal",
            'image'=> "1667124730.jpg",
        ]);

        Course::insert([
            "user_id"=>1,
            'name'=> "Vue.js",
            "title"=>"تصميم مواقع",
            'description'=> "اطار عمل يستخدم الغة البرمجية javaScript تعمل على تصميم المواقع الالكترونية",
            'br_id' => 1,
            'lg_id'=> 3,
            'state'=>"FW",
            'image'=> "1667149996.jpg",
        ]);


        Course::insert([
            "user_id"=>1,
            "title"=>"برمجة مواقع",
            'name'=> "Django",
            'description'=> "اطار عمل يستخدم اللغة البرمجية python ويعمل على برمجة  مواقع الكترونية ",
            'br_id' => 2,
            'lg_id'=> 4,
            'state'=>"FW",
            'image'=> "1667149771.jpg",
        ]);
    }
}
