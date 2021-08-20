<?php

namespace App\Calculator;

use App\Enums\BuildingType;
use JetBrains\PhpStorm\Pure;

class ConstructBuildingCalculator
{
    private array $constructionCosts = [
        BuildingType::FARM => [
            SupplyType::FOOD => 10,
            SupplyType::WOOD => 10,
            SupplyType::STONE => 30,
        ],
        BuildingType::LUMBER_YARD => [
            SupplyType::FOOD => 10,
            SupplyType::WOOD => 40,
        ],
        BuildingType::MINE => [
            SupplyType::FOOD => 10,
            SupplyType::WOOD => 20,
            SupplyType::STONE => 20,
        ],
    ];

    /**
     * @param string $buildingType
     * @return array{ foo: string, bar: string }
     */
    #[Pure]
    public function getSupplyCosts(string $buildingType): array
    {
        return [];
    }
}
