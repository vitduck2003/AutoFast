<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {

        DB::table('role')->insert([
            'name' => 'manager',
            'display_name' => 'Quản lý',
        ]);
        DB::table('role')->insert([
            'name' => 'employee',
            'display_name' => 'Nhân viên',
        ]);
        DB::table('role')->insert([
            'name' => 'customer',
            'display_name' => 'Khách hàng',
        ]);
    }
}