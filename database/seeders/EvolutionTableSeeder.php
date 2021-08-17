<?php

namespace Database\Seeders;

use App\Models\Evolution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EvolutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evolutions = [
            'Prehistoric Age',
            'Stone Age',
            'Copper Age',
            'Bronze Age',
            'Dark Age',
            'Middle Age',
            'Renaissance Age',
            'Imperial Age',
            'Industrial Age',
            'WW1 Age',
            'WW2 Age',
            'Modern Age',
            'Digital Age',
            'Nano Age',
        ];

        $experience = 0;

        foreach ($evolutions as $name) {

            $experience *= 1.75;
            $experience += 10;
            $experience = ceil($experience);

            // Example XP rates with above formula:
            // 10
            // 28
            // 59
            // 114
            // 210
            // 378
            // 672
            // 1186
            // 2086
            // 3661
            // 6417
            // 11240
            // 19680
            // 34450

            if (Evolution::where('name', $name)->exists()) {
                continue;
            }

            $slug = Str::slug($name);

            Evolution::updateOrCreate([
                'slug' => $slug,
            ], [
                'name' => $name,
                'requirements' => [
                    'experience' => $experience,
                ],
            ]);
        }
    }
}
