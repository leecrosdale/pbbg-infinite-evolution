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
        $i = 0;

        foreach ($evolutions as $name) {

            $formattedExperience = number_format($experience);
            $this->command->getOutput()->text("$name ({$formattedExperience} xp)");

            Evolution::updateOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
                'requirements' => [
                    'experience' => $experience,
                ],
                'order' => $i
            ]);

            $experience *= 1.5;
            $experience += 100;
            $experience = ceil($experience);

            $i++;

            // Example XP rates with above formula:
            // 0
            // 100
            // 250
            // 475
            // 813
            // 1,320
            // 2,080
            // 3,220
            // 4,930
            // 7,495
            // 11,343
            // 17,115
            // 25,773
            // 38,760

        }
    }
}
