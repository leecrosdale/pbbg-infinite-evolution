<?php

namespace App\Actions;

use App\Enums\BuildingType;

class UpgradeBuildingAction
{
    // todo: move to BuildingType enum class?
    public static array $validBuildingTypes = [
        BuildingType::FARM,
        BuildingType::LUMBER_YARD,
        BuildingType::MINE,
    ];

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}
