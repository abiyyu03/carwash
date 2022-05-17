<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'id_product_category' => 1,
                'category_name' => 'Aksesoris',
                'product_type_id' => 1
            ],
            [
                'id_product_category' => 2,
                'category_name' => 'Makanan/Minuman',
                'product_type_id' => 1
            ],
            [
                'id_product_category' => 3,
                'category_name' => 'Cuci Motor',
                'product_type_id' => 2
            ],
            [
                'id_product_category' => 4,
                'category_name' => 'Cuci Mobil',
                'product_type_id' => 2
            ],
            [
                'id_product_category' => 5,
                'category_name' => 'Paket Steam',
                'product_type_id' => 2
            ]
        ]);
    }
}
