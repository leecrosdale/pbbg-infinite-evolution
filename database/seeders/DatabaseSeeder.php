<?php

namespace Database\Seeders;

use App\Models\Evolution;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        if (config('app.env') === 'local')
        {
            Evolution::factory(10)->create();
            Location::factory(10)->create();
        }
        else
        {
            $this->call(
                EvolutionTableSeeder::class,
                LocationTableSeeder::class
            );
        }
    }
}
