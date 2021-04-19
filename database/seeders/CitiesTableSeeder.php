<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('cities')->delete();
        $states = [
            ['id' => 1, 'name' => "Halifax", 'province_id' => 1],
            ['id' => 2, 'name' => "Montreal", 'province_id' => 1],
            ['id' => 3, 'name' => "Palo Alto", 'province_id' => 2],
        ];
        \Illuminate\Support\Facades\DB::table('cities')->insert($states);
    }
}
