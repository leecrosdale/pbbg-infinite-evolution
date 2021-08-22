<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\Character;

trait SupplyGuards
{
    private function guardAgainstInsufficientSupplies(Character $character, array $supplyCosts): void
    {
        foreach ($supplyCosts as $supplyType => $requiredAmount) {
            if ($character->{"supply_{$supplyType}"} < $requiredAmount) {
                $supplyName = snake_case_to_words($supplyType);
                throw new GameException("You do not have enough {$supplyName} to perform this action.");
            }
        }
    }
}
