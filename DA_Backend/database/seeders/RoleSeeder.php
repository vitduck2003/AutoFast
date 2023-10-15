<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role')->insert([
            "name" => "Admin",
        ]);
        DB::table('role')->insert([
            "name" => "Nhân Viên",
        ]);
        DB::table('role')->insert([
            "name" => "Thợ",
        ]);
        DB::table('role')->insert([
            "name" => "Khách Hàng",
        ]);
    }
}
