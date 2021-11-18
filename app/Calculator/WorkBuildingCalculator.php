<?php

namespace App\Calculator;

use App\Enums\BuildingType;
use App\Enums\SupplyType;
use App\Models\Character;
use App\Models\CharacterBuilding;
use App\Models\Evolution;

class WorkBuildingCalculator
{
    private const ENERGY_COST = 3;
    private const COOLDOWN_IN_SECONDS_PER_LEVEL = 10;
    private const MAX_COOLDOWN = 60;

    private array $workGains = [
        BuildingType::SCAVENGERS_HUT => [
            SupplyType::FOOD => 3,
            SupplyType::WOOD => 3,
            SupplyType::STONE => 3,
        ],
        BuildingType::FARM => [
            SupplyType::FOOD => 5,
        ],
        BuildingType::LUMBER_YARD => [
            SupplyType::WOOD => 5,
        ],
        BuildingType::MINE => [
            SupplyType::STONE => 5,
        ],
        BuildingType::ALCHEMY_LAB => [
            SupplyType::GOLD => 2,
        ],
    ];

    /**
     * Returns the energy cost for an $evolution order for work at building $buildingType.
     *
     * @param Evolution $evolution
     * @param string $buildingType
     * @return int
     */
    public function getEnergyCost(Evolution $evolution, string $buildingType): int
    {
        return static::ENERGY_COST  * (($evolution->order + 1) * 2);
    }

    /**
     * Returns the cool-down in seconds between work actions on a single
     * building.
     *
     * @param Character $character
     * @param CharacterBuilding $building
     * @return int
     */
    public function getCooldownInSeconds(Character $character, CharacterBuilding $building): int
    {
        return min(
            ($building->level * static::COOLDOWN_IN_SECONDS_PER_LEVEL),
            static::MAX_COOLDOWN
        );
    }

    /**
     * Returns the supply gains when performing a work action on the building.
     *
     * @param Evolution $evolution
     * @param string $buildingType
     * @param int $buildingLevel
     * @param int $buildingHealthPercentage
     * @return array<SupplyType, int>
     */
    public function getSupplyGains(Evolution $evolution, string $buildingType, int $buildingLevel = 1, int $buildingHealthPercentage = 100): array
    {
//        $supplyGainsMultiplier = ((($buildingHealthPercentage / 2) + 50) / 100);
        // 1.0 multiplier at 100% building hp
        // 0.5 multiplier at 0% building hp
        // Scales linearly

        $supplyGainsMultiplier = ($evolution->order + 1) * 2;


        $supplyGains = $this->workGains[$buildingType];

        $supplyGains = array_map(fn($value) => ($value * $buildingLevel), $supplyGains);
        $supplyGains = array_map(fn($value) => (int)ceil($value * $supplyGainsMultiplier), $supplyGains);

        return $supplyGains;
    }
}
