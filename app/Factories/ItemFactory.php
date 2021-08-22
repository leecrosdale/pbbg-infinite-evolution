<?php

namespace App\Factories;

use App\Models\Item;

class ItemFactory
{
    private static array $defaultBuffs = [
        'strength',
        'stamina',
    ];

    public function generateRandomBuff(Item $item): Item
    {
        $buffs = static::$defaultBuffs;

        $appliedBuffs = [];

        foreach ($buffs as $buff) {
            $appliedBuffs[$buff] = random_int(1, 5) * ($item->evolution->order + 1);
        }

        $item->buffs = $appliedBuffs;
        $item->save();

        return $item;
    }

    public function generateRandomRecipe(Item $item): Item
    {
        $baseItems = Item::base()->get()->shuffle();
        $itemAmount = random_int(1, $baseItems->count());

        $recipe = [];
        $i = 0;
        foreach ($baseItems as $baseItem) {
            $recipe[] = ['item_id' => $baseItem->id, 'qty' => random_int(1, 5) * ($item->evolution->order + 1)]; // QTY Required

            $i++;

            if ($itemAmount === $i) {
                break;
            }
        }

        $item->recipe = $recipe;
        $item->save();

        return $item;
    }
}
