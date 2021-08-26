<?php

namespace Database\Seeders;

use Database\Seeders\Production\ProdLocationTableSeeder;
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
                ProdLocationTableSeeder::class,
                ItemTableSeeder::class
            ]
        );
    }
}
