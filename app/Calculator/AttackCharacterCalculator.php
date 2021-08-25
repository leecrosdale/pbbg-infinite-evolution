<?php

namespace App\Calculator;

use App\Models\Character;
use App\Models\CharacterBuilding;
use App\Models\Item;

class AttackCharacterCalculator
{
    private const ATTACK_ENERGY_COST = 15;

    public function getEnergyCost(Character $character)
    {
        return static::ATTACK_ENERGY_COST;
    }

    public function calculateRemainingHealth(Character $character, int $damage)
    {
        $remainingHealth = $character->health - $damage;
        return $remainingHealth < 0 ? 0 : $remainingHealth; // todo: max(x, 0)
    }

    public function calculateRemainingBuildingHealth(CharacterBuilding $building, int $damage)
    {
        $remainingHealth = $building->health - $damage;
        return $remainingHealth < 0 ? 0 : $remainingHealth; // todo: max(x, 0)
    }
}
