<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\Evolution;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class CraftItemAction
{
    private const ENERGY_COST_TO_CRAFT = 1;

    public function __invoke(Character $character, Item $item)
    {
        $this->guardAgainstNotEnoughItemQty($character, $item);
        $this->guardAgainstEvolution($character->evolution, $item);
        $this->guardAgainstNotEnoughEnergy($character);
        $this->guardAgainstNotCraftable($item);

        // Deduct item qty

        DB::transaction(function () use ($item, $character) {
            foreach ($item->recipe as $recipe) {
                $supplyItem = Item::find($recipe->item_id);
                $characterItem = $character->items()->withPivot(['qty'])->where('id', $supplyItem->id)->first();
                $character->items()->updateExistingPivot($supplyItem->id, ['qty' => $characterItem->pivot->qty - $recipe->qty]);
            }

            $character->updateItem($item, 1);

            $character->addExperience(static::ENERGY_COST_TO_CRAFT);
            $character->energy -= static::ENERGY_COST_TO_CRAFT;

            $character->save();
        });
    }

    private function guardAgainstEvolution(Evolution $evolution, Item $item): void
    {
        if ($evolution->order > $item->evolution->order) {
            throw new GameException("Your evolution does not match this item.");
        }
    }

    private function guardAgainstNotCraftable(Item $item)
    {
        if (!$item->isCraftable) {
            throw new GameException("This item is not craftable.");
        }
    }

    private function guardAgainstNotEnoughItemQty(Character $character, Item $item)
    {
        foreach ($item->recipe as $recipe) {
            $supplyItem = Item::find($recipe->item_id);
            if (!$character->hasItemQty($supplyItem, $recipe->qty)) {
                throw new GameException("You lack the items to craft a {$item->name}.");
            }
        }
    }

    private function guardAgainstNotEnoughEnergy(Character $character): void
    {
        if ($character->energy <= 0) {
            throw new GameException("You need (" . static::ENERGY_COST_TO_CRAFT . ") energy to craft this item.");
        }
    }
}
