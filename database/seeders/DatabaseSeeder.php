<?php

namespace Database\Seeders;

use Database\Seeders\Production\ProdLocationTableSeeder;
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

        if (config('app.env') !== 'prod') {

            $this->call([
                RoundTableSeeder::class,
                EvolutionTableSeeder::class,
                LocationTableSeeder::class,
                ItemTableSeeder::class,
                UserTableSeeder::class,
                CharacterTableSeeder::class,
            ]);

        } else {
            $this->call(ProdLocationTableSeeder::class);
        }
    }
}
