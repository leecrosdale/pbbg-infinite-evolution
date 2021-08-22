<?php

namespace App\Actions;

use App\Calculator\TravelCalculator;
use App\Enums\CharacterStatus;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\Location;

class TravelAction
{
    public function __construct(
        private TravelCalculator $travelCalculator,
    )
    {
    }

    public function __invoke(Character $character, Location $destination): void
    {
        $this->guardAgainstSameLocation($character, $destination);
        $this->guardAgainstInsufficientEnergy($character, $destination);
        $this->guardAgainstTooHighEvolution($character, $destination);

        $character->energy -= $this->travelCalculator->getEnergyCost($character, $destination);
        $character->location_id = $destination->id;
        $character->status = CharacterStatus::TRAVELLING;
        $character->status_free_at = now()->addSeconds(
            $this->travelCalculator->getTravelTimeInSeconds($character, $destination)
        );

        $character->save();
    }

    private function guardAgainstSameLocation(Character $character, Location $destination): void
    {
        if ($character->location->id === $destination->id) {
            throw new GameException("You are already at {$destination->name}.");
        }
    }

    private function guardAgainstInsufficientEnergy(Character $character, Location $destination): void
    {
        if ($character->energy < $this->travelCalculator->getEnergyCost($character, $destination)) {
            throw new GameException("You do not have enough energy to travel to {$destination->name}.");
        }
    }

    private function guardAgainstTooHighEvolution(Character $character, Location $destination): void
    {
        if ($character->evolution->order < $destination->evolution->order) {
            throw new GameException("You do not have the required evolution to travel to {$destination->name}.");
        }
    }
}
