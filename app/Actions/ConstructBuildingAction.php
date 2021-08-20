<?php

namespace App\Actions;

use App\Calculator\ConstructBuildingCalculator;
use App\Enums\BuildingType;
use App\Exceptions\GameException;
use App\Models\Character;

class ConstructBuildingAction
{
    public function __construct(
        private ConstructBuildingCalculator $calculator,
    )
    {
    }

    public function __invoke(Character $character, string $buildingType)
    {
        $this->guardAgainstInvalidBuildingType($buildingType);
        $this->guardAgainstAlreadyConstructedBuilding($character, $buildingType);
        $this->guardAgainstUnaffordableConstructionCosts($character, $buildingType);

        // TODO: Implement __invoke() method.
    }

    private function guardAgainstInvalidBuildingType(string $buildingType): void
    {
        if (!in_array($buildingType, BuildingType::$buildingTypes, true)) {
            throw new GameException('You cannot construct that building type.');
        }
    }

    private function guardAgainstAlreadyConstructedBuilding(Character $character, string $buildingType): void
    {
        $hasBuilding = $character->buildings()->where([
            'location_id' => $character->location->id,
            'type' => $buildingType,
        ])->exists();

        if ($hasBuilding) {
            throw new GameException("You already have a {$buildingType} at {$character->location->name}.");
        }
    }

    private function guardAgainstUnaffordableConstructionCosts(Character $character, string $buildingType): void
    {
        $requiredSupplies = $this->calculator->getSupplyCosts($buildingType);

        // todo
    }
}
