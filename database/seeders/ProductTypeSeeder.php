<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            [
                'id_product_type' => 1,
                'product_type' => 'produk'
            ],
            [
                'id_product_type' => 2,
                'product_type' => 'servis'
            ]
        ]);
    }
}
