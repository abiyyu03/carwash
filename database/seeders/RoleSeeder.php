<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id_role' => 1,
                'role_name' => 'owner'
            ],
            [
                'id_role' => 2,
                'role_name' => 'supervisor'
            ],
            [
                'id_role' => 3,
                'role_name' => 'cashier'
            ],
            [
                'id_role' => 4,
                'role_name' => 'employee'
            ]
        ]);
    }
}
