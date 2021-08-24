<?php

namespace App\Calculator;

use App\Models\Character;
use App\Models\CharacterBuilding;

class UpgradeBuildingCalculator
{
    private const ENERGY_COST = 10;
    private const LEVEL_COST_MULTIPLIER = 2;

    public function __construct(
        private ConstructBuildingCalculator $constructBuildingCalculator,
    )
    {
    }

    // todo: docblock
    public function getEnergyCost(Character $character, string $buildingType): int
    {
        return static::ENERGY_COST;
    }

    // todo: docblock
    public function getSupplyCosts(string $buildingType, CharacterBuilding $building): array
    {
        $supplyCosts = $this->constructBuildingCalculator->getSupplyCosts($buildingType);

        $supplyCosts = array_map(fn($value) => ($value * ($building->level ** 2) * static::LEVEL_COST_MULTIPLIER), $supplyCosts);

        return $supplyCosts;
    }

    // todo: docblock
    public function canAffordUpgrade(Character $character, CharacterBuilding $building): bool
    {
        $supplyCosts = $this->getSupplyCosts($building->type, $building);

        foreach ($supplyCosts as $supplyType => $requiredAmount) {
            $qty = $character->items
                    ->where('name', snake_case_to_words($supplyType))
                    ->first()?->pivot->qty ?? 0;

            if ($qty < $requiredAmount) {
                return false;
            }
        }

        return true;
    }
}
