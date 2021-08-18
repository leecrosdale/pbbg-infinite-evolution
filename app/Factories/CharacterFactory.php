<?php

namespace App\Factories;

use App\Models\Character;
use App\Models\Evolution;
use App\Models\User;

class CharacterFactory
{
    private static $defaultValues = [
        'health' => 500,
        'energy' => 100,
        'strength' => 1,
        'stamina' => 1,
    ];

    public function createForUser(User $user): Character
    {
        $evolution = Evolution::first();
        $location = $evolution->locations()->inRandomOrder()->first();

        return $user->characters()->create([
            'evolution_id' => $evolution->id,
            'location_id' => $location->id,

            'name' => $user->name,

            'level' => 0,
            'experience' => 0,

            'health' => static::$defaultValues['health'],
            'max_health' => static::$defaultValues['health'],
            'energy' => static::$defaultValues['energy'],
            'max_energy' => static::$defaultValues['energy'],

            'strength' => static::$defaultValues['strength'],
            'stamina' => static::$defaultValues['stamina'],
        ]);
    }
}
