<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = array(
            array(
                'city' => 'New York',
                'lat' => '40.730610',
                'lon' => '-73.935242',
            ),
            array(
                'city' => 'London',
                'lat' => '51.507351',
                'lon' => '-0.127758',
            ),
            array(
                'city' => 'Paris',
                'lat' => '48.856613',
                'lon' => '2.352222',
            ),
            array(
                'city' => 'Berlin',
                'lat' => '52.520008',
                'lon' => '13.404954',
            ),
            array(
                'city' => 'Tokyo',
                'lat' => '35.689487',
                'lon' => '139.691711',
            ),
        );

        Location::insert($locations);
    }
}
