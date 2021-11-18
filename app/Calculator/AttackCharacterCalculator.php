<?php

namespace App\Calculator;

use App\Models\Character;
use App\Models\CharacterBuilding;
use App\Models\Item;

class AttackCharacterCalculator
{
    private const ATTACK_ENERGY_COST = 100;

    public function getEnergyCost(Character $character)
    {
        return static::ATTACK_ENERGY_COST;
    }

    public function calculateRemainingHealth(Character $character, int $damage): int
    {
        $remainingHealth = floor($character->health - $damage);
        return max($remainingHealth, 0);
    }

    public function calculateRemainingBuildingHealth(CharacterBuilding $building, int $damage): int
    {
        $remainingHealth = floor($building->health - $damage);
        return max($remainingHealth, 0);
    }
}
