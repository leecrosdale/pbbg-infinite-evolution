<?php

namespace App\Calculator;

use App\Enums\BuildingType;
use App\Enums\SupplyType;
use JetBrains\PhpStorm\Pure;

class WorkBuildingCalculator
{
    private array $workGains = [
        BuildingType::FARM => [
            SupplyType::FOOD => 5,
        ],
        BuildingType::LUMBER_YARD => [
            SupplyType::WOOD => 5,
        ],
        BuildingType::MINE => [
            SupplyType::STONE => 5,
        ],
    ];

    /**
     * Returns the supply gains when performing a work action on the building.
     *
     * @param string $buildingType
     * @return array<SupplyType, int>
     */
    #[Pure]
    public function getWorkGains(string $buildingType): array
    {
        return $this->workGains[$buildingType];
    }
}
