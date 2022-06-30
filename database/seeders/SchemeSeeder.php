<?php

namespace Database\Seeders;

use App\Models\Scheme\Scheme;
use Illuminate\Database\Seeder;

class SchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scheme::create([
            "scheme_name" => "FIRST TEST SCHEME",
            "scheme_start_date" => "2021-10-12",
            "scheme_end_date" => "2021-10-12",
        ]);

        // Scheme::create([
        //     "scheme_name" => "SECOND TEST SCHEME",
        //     "scheme_start_date" => "2022-10-12",
        //     "scheme_end_date" => "2022-10-12",
        // ]);
    }
}
