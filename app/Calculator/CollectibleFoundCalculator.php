<?php

namespace App\Calculator;


use App\Models\Item;

class CollectibleFoundCalculator
{

    public function calculateIfCollectibleIsFound(Item $item) : bool
    {
        $guess = random_int(0,100);
        return $guess <= $item->chance_percentage;
    }

}
