<?php

namespace App\Calculator;

use App\Models\Character;
use App\Models\CharacterBuilding;
use App\Models\Item;

class AttackCharacterCalculator
{

    public function calculateRemainingHealth(Character $character, int $damage)
    {
        $remainingHealth = $character->health - $damage;
        return $remainingHealth < 0 ? 0 : $remainingHealth;
    }

    public function calculateRemainingBuildingHealth(CharacterBuilding $building, int $damage)
    {
        $remainingHealth = $building->health - $damage;
        return $remainingHealth < 0 ? 0 : $remainingHealth;
    }

}
