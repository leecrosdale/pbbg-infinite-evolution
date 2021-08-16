<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    private const LOCATIONS_TO_GENERATE = 1000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Location::count();

        $amountToGenerate = static::LOCATIONS_TO_GENERATE - $count;

        if ($amountToGenerate > 0) {
            Location::factory($amountToGenerate)->create();
        }
    }
}
