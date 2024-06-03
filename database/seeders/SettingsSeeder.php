<?php

namespace Database\Seeders;
use App\Models\General_settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        General_settings::insert([
            'website_name'=>"منصة التقنية",
            'website_E_name'=>"IT-PlatForm",
            'website_title'=>"نقدم كورسات مجانية",
            'website_descriptions'=>"منصتنا تقوم بتعليم البرمجة و تخصصات البرمجة لتسهيل على المستخدم تعلم البرمجة ومعرفة الكورساتالمناسبة",
            'website_copy_right'=>" IT-PladForm 2022",
        ]);
    }
}
