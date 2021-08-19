<?php

namespace App\Actions;

use App\Enums\CharacterStatus;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\Location;

class TravelAction
{
    public function __invoke(Character $character, Location $location)
    {
        $this->guardAgainstSameLocation($character, $location);
        $this->guardAgainstInsufficientEnergy($character, $location);
        $this->guardAgainstEvolutionOrder($character, $location);

        $character->energy -= $location->energy_required;
        $character->location_id = $location->id;
        $character->status = CharacterStatus::TRAVELLING;
        $character->status_free_at = now()->addSeconds($location->seconds_required);
        $character->save();
    }

    private function guardAgainstSameLocation(Character $character, Location $location): void
    {
        if ($character->location->id === $location->id) {
            throw new GameException("You are already at {$location->name}.");
        }
    }

    private function guardAgainstInsufficientEnergy(Character $character, Location $location): void
    {
        if ($character->energy < $location->energy_required) {
            throw new GameException("You do not have enough energy to travel to {$location->name}.");
        }
    }

    private function guardAgainstEvolutionOrder(Character $character, Location $location): void
    {
        if ($character->evolution->order < $location->evolution->order) {
            throw new GameException("You do not have the required evolution to travel to {$location->name}.");
        }
    }
}
