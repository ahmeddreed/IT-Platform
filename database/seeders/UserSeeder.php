<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 111111;
        User::insert([
            "name"=>"Ahmed dreed",
            "email"=>"ahmed@gmail.com",
            "password"=>Hash::make($password),
            "role_id"=>1,//Super Admin
            "gender"=>"m",
        ]);
        // User::factory()->times(5)->create();

    }
}
