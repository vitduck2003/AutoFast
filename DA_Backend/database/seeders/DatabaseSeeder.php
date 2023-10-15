<?php

namespace Database\Seeders;

use RoleSeeder;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $this->call(UserSeeder::class);
    }
}