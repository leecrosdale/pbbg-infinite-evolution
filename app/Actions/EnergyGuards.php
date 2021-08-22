<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\Character;

trait EnergyGuards
{
    private function guardAgainstInsufficientEnergy(Character $character, int $energyCost): void
    {
        if ($character->energy < $energyCost) {
            throw new GameException('You do not have enough energy to perform this action.');
        }
    }
}
