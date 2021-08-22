<?php

namespace App\Calculator;

use App\Enums\BuildingType;
use App\Enums\SupplyType;
use App\Models\Character;

class ConstructBuildingCalculator
{
    private const ENERGY_COST = 10;

    private array $constructionCosts = [
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
    ];

    /**
     * Returns the energy cost for $character to construct building
     * $buildingType at their current location.
     *
     * @param Character $character
     * @param string $buildingType
     * @return int
     */
    public function getEnergyCost(Character $character, string $buildingType): int
    {
        return static::ENERGY_COST;
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
}
