<?php

namespace App\Calculator;

use App\Enums\BuildingType;
use JetBrains\PhpStorm\Pure;

class ConstructBuildingCalculator
{
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
     * @param string $buildingType
     * @return array{ foo: string, bar: string }
     */
    #[Pure]
    public function getSupplyCosts(string $buildingType): array
    {
        return [];
    }
}
