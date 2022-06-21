<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'name' => 'Owner Carwash',
                'email' => 'jiwalucarwashapp@gmail.com',
                'password' => bcrypt(123123123123),
                'role_id' => 1
            ]
        ]);
    }
}
