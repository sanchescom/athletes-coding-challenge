<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('provinces')->delete();
        $provinces = [
            ['id' => 1, 'name' => "Nova Scotia", 'code' => 'NS', 'country_id' => 1],
            ['id' => 2, 'name' => "Quebec", 'code' => 'QC', 'country_id' => 1],
            ['id' => 3, 'name' => "California", 'code' => 'CA', 'country_id' => 2],
        ];
        \Illuminate\Support\Facades\DB::table('provinces')->insert($provinces);
    }
}
