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
        Round::factory()->create(['number' => 1, 'ended_at' => null]);
    }
}
