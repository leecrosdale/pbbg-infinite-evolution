<?php

namespace App\Factories;

use App\Enums\CharacterStatType;
use App\Models\Item;

class ItemFactory
{
    private static array $defaultBuffs = [
        CharacterStatType::ATTACK,
        CharacterStatType::DEFENCE
    ];

    public function generateRandomBuff(Item $item): Item
    {
        $buffs = static::$defaultBuffs;

        $appliedBuffs = [];

        $buffRange = 0;



        $buffRange = 0;
        $previousBuff = null;

        foreach ($buffs as $buff) {
            $appliedBuffs[$buff] = random_int(-5, 5) * ($item->evolution->order + 1);
            
            if ($previousBuff < 0) {
                $appliedBuffs[$buff] = abs($appliedBuffs[$buff]);
            }

            $previousBuff = $appliedBuffs[$buff];

            $buffRange += $appliedBuffs[$buff];
        }

        if ($buffRange < -3) {
            $name = 'Terrible';
        } else if ($buffRange < 0) {
            $name = 'Poor';
        } else if ($buffRange === 0) {
            $name = 'Normal';
        } else if ($buffRange <= 3) {
            $name = 'Good';
        } else {
            $name = 'Brilliant';
        }

        $item->name = "{$name} {$item->name}";

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
