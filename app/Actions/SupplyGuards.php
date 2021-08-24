<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\CharacterBuilding;

trait SupplyGuards
{
    private function guardAgainstInsufficientSupplies(Character $character, CharacterBuilding $building): void
    {
        if (!$this->calculator->canAffordUpgrade($character, $building)) {
            $buildingName = snake_case_to_words($building->type);
            throw new GameException("You do not have enough supplies to upgrade your {$buildingName}.");
        }
    }
}
