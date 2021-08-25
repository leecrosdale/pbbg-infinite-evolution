<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductionContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
                RoundTableSeeder::class,
                EvolutionTableSeeder::class,
                LocationTableSeeder::class,
            ]
        );
    }
}
