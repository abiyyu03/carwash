<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OutcomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('outcome_types')->insert([
            [
                'id_outcome_type' => 1,
                'outcome_type' => 'fix_cost'
            ],
            [
                'id_outcome_type' => 2,
                'outcome_type' => 'variable_cost'
            ],
        ]);
    }
}
