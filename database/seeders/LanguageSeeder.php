<?php

namespace Database\Seeders;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            "user_id"=>1,
            "name"=>"Html"
        ]);
        Language::create([
            "user_id"=>1,
            "name"=>"Css"
        ]);
        Language::create([
            "user_id"=>1,
            "name"=>"javascript"
        ]);
        Language::create([
            "name"=>"python",
            "user_id"=>1,
        ]);
        Language::create([
            "user_id"=>1,
            "name"=>"php"
        ]);
        Language::create([
            "user_id"=>1,
            "name"=>"C#"
        ]);

    }
}
