<?php

namespace App\Enums;

class BuildingType extends Enum
{
    public const FARM = 'farm'; // +Food
    public const LUMBER_YARD = 'lumber_yard'; // +Wood
    public const MINE = 'mine'; // +Stone
    public const ALCHEMY_LAB = 'alchemy_lab'; // +Gold
}
