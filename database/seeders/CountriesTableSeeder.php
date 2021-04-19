<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('countries')->delete();
        \Illuminate\Support\Facades\DB::table('countries')->insert(
            [
                ['id' => 1, 'name' => "Canada"],
                ['id' => 2, 'name' => "United States"],
            ]
        );
    }
}
