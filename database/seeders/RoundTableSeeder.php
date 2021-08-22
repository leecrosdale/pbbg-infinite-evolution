<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Seeder;

class RoundTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Round::updateOrCreate([
            'number' => 1,
        ], [
            'started_at' => now(),
        ]);
    }
}
