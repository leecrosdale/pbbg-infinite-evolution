<?php

namespace Database\Seeders;

use App\Models\Evolution;
use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    private const LOCATIONS_PER_EVOLUTION = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evolutions = Evolution::all();

        foreach ($evolutions as $evolution) {
            $locationsToGenerate = (static::LOCATIONS_PER_EVOLUTION - $evolution->locations()->count());

            if ($locationsToGenerate <= 0) {
                continue;
            }

            $evolution->locations()->saveMany(
                Location::factory()
                    ->count($locationsToGenerate)
                    ->make()
            );
        }
    }
}
