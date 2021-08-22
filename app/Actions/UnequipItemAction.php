<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\Item;

class UnequipItemAction
{
    private const ENERGY_COST_TO_UNEQUIP = 1;

    public function __invoke(Character $character, Item $item)
    {
        $this->guardAgainstNoItem($character, $item);
        $this->guardAgainstNotEquipped($character, $item);
        $this->guardAgainstNotEnoughEnergy($character);

        $character->items()->updateExistingPivot($item->id, ['equipped' => false]);

        $character->energy -= static::ENERGY_COST_TO_UNEQUIP;
        $character->save();

    }

    private function guardAgainstNotEnoughEnergy(Character $character): void
    {
        if ($character->energy <= 0)
        {
            throw new GameException("You need (" . static::ENERGY_COST_TO_UNEQUIP . ") energy to un-equip an item.");
        }
    }

    private function guardAgainstNotEquipped(Character $character, Item $item): void
    {
        if (!$character->items()->where('id', $item->id)->wherePivot('equipped', true)->exists())
        {
            throw new GameException("{$item->name} is not equipped.");
        }
    }

    private function guardAgainstNoItem(Character $character, Item $item): void
    {
        if (!$character->items()->wherePivot('qty','>=', 1)->where('id', $item->id)->exists()) {
            throw new GameException("You need to own the {$item->name} to unequip it.");
        }
    }
}
