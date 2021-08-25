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
            'Bronze Age',
            'Middle Age',
            'Imperial Age',
            'Industrial Age',
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

            $experience *= 2;
            $experience += 100;
            $experience = ceil($experience);

            $order++;
        }
    }
}
