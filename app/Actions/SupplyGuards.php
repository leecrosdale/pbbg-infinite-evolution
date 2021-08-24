<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\Character;

trait SupplyGuards
{
    private function guardAgainstInsufficientSupplies(Character $character, array $supplyCosts): void
    {
        foreach ($supplyCosts as $supplyType => $requiredAmount) {
            $qty = $character->items
                    ->where('name', snake_case_to_words($supplyType))
                    ->first()?->pivot->qty ?? 0;

            if ($qty < $requiredAmount) {
                $supplyName = snake_case_to_words($supplyType);
                throw new GameException("You do not have enough {$supplyName} to perform this action.");
            }
        }
    }
}
