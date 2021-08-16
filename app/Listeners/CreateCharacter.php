<?php

namespace App\Listeners;

use App\Models\Evolution;
use Illuminate\Auth\Events\Registered;

class CreateCharacter
{
    public function handle(Registered $event)
    {
        $evolution = Evolution::first();
        $location = $evolution->locations()->inRandomOrder()->first();

        $event->user->characters()->create([
            'evolution_id' => $evolution->id,
            'location_id' => $location->id,

            'name' => $event->user->name,

            'level' => 0,
            'experience' => 0,

            'health' => 500,
            'max_health' => 500,
            'energy' => 100,
            'max_energy' => 100,

            'strength' => 1,
            'stamina' => 1,
        ]);
    }
}
