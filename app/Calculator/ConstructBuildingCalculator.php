<?php

namespace App\Calculator;

use App\Enums\BuildingType;
use App\Enums\SupplyType;
use App\Models\Character;
use App\Models\Evolution;

class ConstructBuildingCalculator
{
    private const ENERGY_COST = 10;

    private array $constructionCosts = [
        BuildingType::SCAVENGERS_HUT => [
            // you cannot build this
        ],
        BuildingType::FARM => [
            SupplyType::FOOD => 25,
            SupplyType::WOOD => 25,
            SupplyType::STONE => 25,
        ],
        BuildingType::LUMBER_YARD => [
            SupplyType::FOOD => 50,
            SupplyType::STONE => 25,
        ],
        BuildingType::MINE => [
            SupplyType::FOOD => 50,
            SupplyType::WOOD => 25,
        ],
        BuildingType::ALCHEMY_LAB => [
            SupplyType::WOOD => 75,
            SupplyType::FOOD => 50,
            SupplyType::STONE => 50,
        ],
    ];

    /**
     * Returns the energy cost for $evolution order to construct a building
     *
     * @param Evolution $evolution
     * @return int
     */
    public function getEnergyCost(Evolution $evolution): int
    {
        return static::ENERGY_COST * (($evolution->order + 1) * 2);
    }

    /**
     * Returns the required supply costs to construct a building with type
     * $buildingType.
     *
     * @param string $buildingType
     * @return array<SupplyType, int>
     */
    public function getSupplyCosts(string $buildingType): array
    {
        return $this->constructionCosts[$buildingType];
    }

    // todo: docblock
    // todo: duplicate code between WorkBuildingCalculator
    // todo: use this in guard in CostructBuildingAction?
    public function canAffordConstruction(Character $character, string $buildingType): bool
    {
        $supplyCosts = $this->getSupplyCosts($buildingType);

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
