<?php

namespace App\Calculator;

use App\Enums\BuildingType;
use App\Enums\SupplyType;
use App\Models\Character;
use App\Models\CharacterBuilding;

class WorkBuildingCalculator
{
    private const ENERGY_COST = 3;
    private const COOLDOWN_IN_SECONDS_PER_LEVEL = 10;

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
     * Returns the energy cost for $character to work at building $buildingType.
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
     * Returns the cooldown in seconds between work actions on a single
     * building.
     *
     * @param Character $character
     * @param string $buildingType
     * @return int
     */
    public function getCooldownInSeconds(Character $character, CharacterBuilding $building): int
    {
        return ($building->level * static::COOLDOWN_IN_SECONDS_PER_LEVEL);
    }

    /**
     * Returns the supply gains when performing a work action on the building.
     *
     * @param string $buildingType
     * @return array<SupplyType, int>
     */
    public function getSupplyGains(string $buildingType, int $buildingLevel = 1): array
    {
        $supplyGains = $this->workGains[$buildingType];

        $supplyGains = array_map(fn($value) => ($value * $buildingLevel), $supplyGains);

        return $supplyGains;
    }
}
