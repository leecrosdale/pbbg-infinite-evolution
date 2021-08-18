<?php

namespace App\Factories;

use App\Models\Character;
use App\Models\Evolution;
use App\Models\Location;
use App\Models\User;

class CharacterFactory
{
    private static $defaultValues = [
        'health' => 500,
        'energy' => 100,
        'strength' => 1,
        'stamina' => 1,
    ];

    private Evolution $evolution;
    private Location $location;

    public function createForUser(?User $user): Character
    {
        // todo: get proper starting evolution, instead of first
        $this->evolution ??= Evolution::first();

        $this->location ??= $this->evolution
            ->locations()
            ->inRandomOrder()
            ->first();

        $characterAttributes = [
            'evolution_id' => $this->evolution->id,
            'location_id' => $this->location->id,

            'level' => 0,
            'experience' => 0,

            'health' => static::$defaultValues['health'],
            'max_health' => static::$defaultValues['health'],
            'energy' => static::$defaultValues['energy'],
            'max_energy' => static::$defaultValues['energy'],

            'strength' => static::$defaultValues['strength'],
            'stamina' => static::$defaultValues['stamina'],
        ];

        if ($user !== null) {
            $characterAttributes['user_id'] = $user->id;
            $characterAttributes['name'] = $user->name;
        } else {
            $characterAttributes['name'] = 'Dummy Character';
        }

        return Character::create($characterAttributes);
    }

    public function setEvolution(Evolution $evolution): static
    {
        $this->evolution = $evolution;
        return $this;
    }

    public function setLocation(Location $location): static
    {
        $this->location = $location;
        return $this;
    }
}
