<?php

namespace App\Actions;

use App\Calculator\WorkBuildingCalculator;
use App\Enums\BuildingType;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\CharacterBuilding;

class WorkBuildingAction
{
    public function __construct(
        private WorkBuildingCalculator $workBuildingCalculator,
    )
    {
    }

    public function __invoke(Character $character, string $buildingType)
    {
        $this->guardAgainstInvalidBuildingType($buildingType);
        $this->guardAgainstNonConstructedBuilding($character, $buildingType);
        $this->guardAgainstInsufficientEnergy($character, $buildingType);
        $this->guardAgainstWorkCooldown($character, $buildingType);

        /** @var CharacterBuilding $building */
        $building = $character->buildings()->where([
            'location_id' => $character->location->id,
            'type' => $buildingType,
        ])->first();

        $energyCost = $this->workBuildingCalculator->getEnergyCost($character, $buildingType);
        $supplyGains = $this->workBuildingCalculator->getSupplyGains($buildingType);

        $character->energy -= $energyCost;

        foreach ($supplyGains as $supplyType => $amount) {
            $character->{"supply_{$supplyType}"} += $amount;
        }

        $building->next_work_at = now()->addSeconds(
            $this->workBuildingCalculator->getNextWorkDelayInSeconds($character, $buildingType)
        );
        $building->save();

        $character->save();
    }

    private function guardAgainstInvalidBuildingType(string $buildingType): void
    {
        if (!in_array($buildingType, BuildingType::$buildingTypes, true)) {
            throw new GameException('You cannot construct that building type.');
        }
    }

    private function guardAgainstNonConstructedBuilding(Character $character, string $buildingType): void
    {
        $hasBuilding = $character->buildings()->where([
            'location_id' => $character->location->id,
            'type' => $buildingType,
        ])->exists();

        if (!$hasBuilding) {
            throw new GameException("You do not have constructed a {$buildingType} at {$character->location->name}.");
        }
    }

    private function guardAgainstInsufficientEnergy(Character $character, string $buildingType): void
    {
        if ($character->energy < $this->workBuildingCalculator->getEnergyCost($character, $buildingType)) {
            throw new GameException("You do not have enough energy to work your {$buildingType}.");
        }
    }

    private function guardAgainstWorkCooldown(Character $character, string $buildingType): void
    {
        /** @var CharacterBuilding $building */
        $building = $character->buildings()->where([
            'location_id' => $character->location->id,
            'type' => $buildingType,
        ])->first();

        if (($building->next_work_at !== null) && ($building->next_work_at > now())) {
            throw new GameException("You cannot work your {$buildingType} yet.");
        }
    }
}
