<?php

namespace App\Models;

use App\Enums\ItemType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'recipe' => 'object'
    ];


    public function scopeBase($query)
    {
        $query->where('type', ItemType::BASE);
    }


    public function generateRecipe()
    {

        $baseItems = Item::base()->get()->shuffle();


        $itemAmount = random_int(2, $baseItems->count());

        $recipe = [];
        $i = 0;
        foreach ($baseItems as $baseItem)
        {
            $recipe[$baseItem->id] = random_int(5,100); // QTY Required

            $i++;

            if ($itemAmount === $i) {
                break;
            }



        }

        $this->recipe = $recipe;
        $this->save();

        return $recipe;


    }

}
