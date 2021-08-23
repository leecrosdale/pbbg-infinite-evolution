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
        $order = 0;

        foreach ($evolutions as $name) {

            $formattedExperience = number_format($experience);
            $this->command->getOutput()->text("$name ({$formattedExperience} xp)");

            Evolution::updateOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
                'experience_required' => $experience,
                'order' => $order
            ]);

            $experience *= 1.5;
            $experience += 100;
            $experience = ceil($experience);

            $order++;
        }
    }
}
