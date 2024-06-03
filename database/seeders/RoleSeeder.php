<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::create([
        "name"=>"SuperAdmin"
      ]);
      Role::create([
        "name"=>"Admin"
      ]);
      Role::create([
        "name"=>"User"
      ]);
    }
}
