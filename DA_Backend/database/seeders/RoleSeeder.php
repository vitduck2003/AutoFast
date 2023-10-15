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
            'name' => 'Manager',
            'display_name' => 'Quản lý',
        ]);
        DB::table('role')->insert([
            'name' => 'Employee',
            'display_name' => 'Nhân viên',
        ]);
        DB::table('role')->insert([
            'name' => 'Customer',
            'display_name' => 'Khách hàng',
        ]);
    }
}
