<?php

namespace App\Factories;

use App\Enums\BuildingType;
use App\Models\Character;
use App\Models\Evolution;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Arr;

class CharacterFactory
{
    private static $defaultValues = [
        'health' => 500,
        'energy' => 100,
        'stats' => [
            'attack' => 1,
            'defence' => 1,
        ],
//        'supplies' => [
//            'food' => 0,
//            'wood' => 0,
//            'stone' => 0,
//        ],
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

            'level' => 1,
            'experience' => 0,

            'health' => Arr::get(static::$defaultValues, 'health'),
            'max_health' => Arr::get(static::$defaultValues, 'health'),
            'energy' => Arr::get(static::$defaultValues, 'energy'),
            'max_energy' => Arr::get(static::$defaultValues, 'energy'),

            'stat_attack' => Arr::get(static::$defaultValues, 'stats.attack'),
            'stat_defence' => Arr::get(static::$defaultValues, 'stats.defence'),
        ];

        if ($user !== null) {
            $characterAttributes['user_id'] = $user->id;
            $characterAttributes['name'] = $user->name;
        } else {
            $characterAttributes['name'] = 'Dummy Character';
        }

        $character = Character::create($characterAttributes);

//        foreach (static::$defaultValues['supplies'] as $supplyType => $amount) {
//            $item = Item::query()
//                ->where('name', snake_case_to_words($supplyType))
//                ->firstOrFail();
//
//            $character->items()->attach($item->id, ['qty' => $amount]);
//        }

        // Create Scavenger's Hut at starting location

        $character->buildings()->create([
            'location_id' => $this->location->id,
            'type' => BuildingType::SCAVENGERS_HUT,
            'level' => 1,
            'health' => 100,
            'max_health' => 100,
        ]);

        return $character;
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
