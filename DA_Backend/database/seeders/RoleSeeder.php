<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {

        // Tạo dữ liệu giả cho các vai trò
        $roles = [
            [
                'name' => 'employee',
                'display_name' => 'Nhân viên',
            ],
            [
                'name' => 'manager',
                'display_name' => 'Quản lý',
            ],
            [
                'name' => 'customer',
                'display_name' => 'Khách hàng',
            ],
        ];

        // Insert dữ liệu vào bảng 'role'
        DB::table('role')->insert($roles);
    }
}