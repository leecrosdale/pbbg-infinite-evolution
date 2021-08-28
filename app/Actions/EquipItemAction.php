<?php

namespace App\Actions;

use App\Enums\ItemType;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\Evolution;
use App\Models\Item;

class EquipItemAction
{
    private const ENERGY_COST_TO_EQUIP = 1;

    public function __invoke(Character $character, Item $item)
    {
        $this->guardAgainstNoItem($character, $item);
        $this->guardAgainstEvolution($character->evolution, $item);
        $this->guardAgainsetUnequippableItem($item);
        $this->guardAgainstAlreadyEquipped($character, $item);
        $this->guardAgainstNotEnoughEnergy($character);

        $character->items()->updateExistingPivot($item->id, ['equipped' => true]);

        $character->addExperience(static::ENERGY_COST_TO_EQUIP);
        $character->energy -= static::ENERGY_COST_TO_EQUIP;

        $character->save();
    }

    private function guardAgainstAlreadyEquipped(Character $character, Item $item): void
    {
        if ($character->hasItemTypeEquipped($item)) {
            throw new GameException("You need to un-equip your other " . snake_case_to_words($item->type) . " first.");
        }
    }

    private function guardAgainstNotEnoughEnergy(Character $character): void
    {
        if ($character->energy <= 0) {
            throw new GameException("You need (" . static::ENERGY_COST_TO_EQUIP . ") energy to equip an item.");
        }
    }

    private function guardAgainsetUnequippableItem(Item $item): void
    {
        if (!$item->equippable) {
            throw new GameException("{$item->name} is not equippable.");
        }
    }

    private function guardAgainstNoItem(Character $character, Item $item): void
    {
        if (!$character->items()->where('id', $item->id)->wherePivot('qty', '>=', 1)->exists()) {
            throw new GameException("You need to own the {$item->name} to equip it.");
        }
    }

    private function guardAgainstEvolution(Evolution $evolution, Item $item): void
    {
        if ($evolution->order < $item->evolution->order && $item->type !== ItemType::COLLECTIBLE) {
            throw new GameException("Your evolution does not match this item.");
        }
    }
}
