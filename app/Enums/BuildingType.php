<?php

namespace App\Enums;

class BuildingType
{
    public static array $buildingTypes = [
        self::FARM,
        self::LUMBER_YARD,
        self::MINE,
    ];

    public const FARM = 'farm'; // +Food
    public const LUMBER_YARD = 'lumber_yard'; // +Wood
    public const MINE = 'mine'; // +Stone

    // todo: brainstorm about buildings below (formulas, functionality etc)

    public const HOUSE = 'house'; // +Population?
    public const MARKET = 'market'; // +Trade?
    public const FACTORY = 'factory'; // +Goods?
}
