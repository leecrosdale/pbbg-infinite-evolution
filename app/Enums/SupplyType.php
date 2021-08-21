<?php

namespace App\Enums;

class SupplyType
{
    public static array $supplyTypes = [
        self::WOOD,
        self::STONE,
        self::WOOD,
    ];

    public const FOOD = 'food';
    public const STONE = 'stone';
    public const WOOD = 'wood';
}
