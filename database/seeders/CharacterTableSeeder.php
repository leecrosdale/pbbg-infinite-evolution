<?php

namespace Database\Seeders;

use App\Factories\CharacterFactory;
use App\Models\Character;
use App\Models\Evolution;
use App\Models\Location;
use Illuminate\Database\Seeder;

class CharacterTableSeeder extends Seeder
{
    private const CHARACTERS_TO_GENERATE = 30;

    public function __construct(
        private CharacterFactory $factory
    )
    {
    }

    public function run(): void
    {
        $amountDummyCharacters = Character::query()
            ->whereNull('user_id')
            ->count();

        $charactersToGenerate = (static::CHARACTERS_TO_GENERATE - $amountDummyCharacters);

        if ($charactersToGenerate <= 0) {
            return;
        }

        for ($i = 0; $i < $charactersToGenerate; $i++) {
            // Put them in random evolutions for now, disregarding evolution xp etc

            /** @var Evolution $evolution */
            $evolution = Evolution::query()->inRandomOrder()->first();

            /** @var Location $location */
            $location = Location::query()->inRandomOrder()->first();

            $this->factory
                ->setEvolution($evolution)
                ->setLocation($location)
                ->createForUser(null);
        }
    }
}
