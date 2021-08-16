<?php

namespace Database\Seeders;

use App\Models\Evolution;
use Illuminate\Database\Seeder;

class EvolutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //    *[ ] Prehistoric Age
        //    *[ ] Stone Age
        //    *[ ] Copper Age
        //    *[ ] Bronze Age
        //    *[ ] Dark Age
        //    *[ ] Middle Age
        //    *[ ] Renaissance Age
        //    *[ ] Imperial Age
        //    *[ ] Industrial Age
        //    *[ ] WW1 Age
        //    *[ ] WW2 Age
        //    *[ ] Modern Age
        //    *[ ] Digital Age
        //    *[ ] Nano Age

        Evolution::factory()->create(['name' => 'Prehistoric Age', 'slug' => 'prehistoric-age']);
        Evolution::factory()->create(['name' => 'Stone Age', 'slug' => 'stone-age']);
        Evolution::factory()->create(['name' => 'Copper Age', 'slug' => 'copper-age']);
        Evolution::factory()->create(['name' => 'Bronze Age', 'slug' => 'bronze-age']);
        Evolution::factory()->create(['name' => 'Dark Age', 'slug' => 'dark-age']);
        Evolution::factory()->create(['name' => 'Middle Age', 'slug' => 'middle-age']);
        Evolution::factory()->create(['name' => 'Renaissance Age', 'slug' => 'renaissance-age']);
        Evolution::factory()->create(['name' => 'Imperial Age', 'slug' => 'imperial-age']);
        Evolution::factory()->create(['name' => 'Industrial Age', 'slug' => 'industrial-age']);
        Evolution::factory()->create(['name' => 'WW1 Age', 'slug' => 'ww1-age']);
        Evolution::factory()->create(['name' => 'WW2 Age', 'slug' => 'ww2-age']);
        Evolution::factory()->create(['name' => 'Modern Age', 'slug' => 'modern-age']);
        Evolution::factory()->create(['name' => 'Digital Age', 'slug' => 'digital-age']);
        Evolution::factory()->create(['name' => 'Nano Age', 'slug' => 'nano-age']);

    }
}
