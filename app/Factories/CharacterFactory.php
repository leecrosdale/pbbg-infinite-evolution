<?php

namespace App\Factories;

use App\Models\Character;
use App\Models\Evolution;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Arr;

class CharacterFactory
{
    private static $defaultValues = [
        'money' => 100,
        'health' => 500,
        'energy' => 100,
        'stats' => [
            'strength' => 1,
            'stamina' => 1,
        ],
        'supplies' => [
            'food' => 100,
            'wood' => 100,
            'stone' => 100,
        ],
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

            'money' => Arr::get(static::$defaultValues, 'money'),

            'health' => Arr::get(static::$defaultValues, 'health'),
            'max_health' => Arr::get(static::$defaultValues, 'health'),
            'energy' => Arr::get(static::$defaultValues, 'energy'),
            'max_energy' => Arr::get(static::$defaultValues, 'energy'),

            'stat_strength' => Arr::get(static::$defaultValues, 'stats.strength'),
            'stat_stamina' => Arr::get(static::$defaultValues, 'stats.stamina'),

            'supply_food' => Arr::get(static::$defaultValues, 'supplies.food'),
            'supply_wood' => Arr::get(static::$defaultValues, 'supplies.wood'),
            'supply_stone' => Arr::get(static::$defaultValues, 'supplies.stone'),
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
