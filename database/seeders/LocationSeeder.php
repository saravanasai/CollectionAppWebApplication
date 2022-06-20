<?php

namespace Database\Seeders;

use App\Models\Location\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public $location_list = [
        ['id' => '001', 'area' => 'test area - 1'],
        ['id' => '002', 'area' => 'test area - 2'],
        ['id' => '003', 'area' => 'test area - 3'],
        ['id' => '004', 'area' => 'test area - 4'],
        ['id' => '005', 'area' => 'test area - 5'],
        ['id' => '006', 'area' => 'test area - 6'],
        ['id' => '007', 'area' => 'test area - 7'],
        ['id' => '008', 'area' => 'test area - 8'],
        ['id' => '009', 'area' => 'test area - 9'],
        ['id' => '010', 'area' => 'test area - 10'],

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0, $length = count($this->location_list); $i < $length; $i++) {
            $location = new Location();
            $location->location_id = $this->location_list[$i]['id'];
            $location->location_name = $this->location_list[$i]['area'];
            $location->save();
        }
    }
}
