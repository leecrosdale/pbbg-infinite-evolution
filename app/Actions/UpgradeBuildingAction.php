<?php

namespace App\Actions;

use App\Enums\BuildingType;
use App\Exceptions\GameException;
use App\Models\Character;

class UpgradeBuildingAction
{
    public function __invoke(Character $character, string $buildingType)
    {
        $this->guardAgainstInvalidBuildingType($buildingType);
        // ensure char already has building at their location
        // ensure upgrade costs are affordable

        // TODO: Implement __invoke() method.
    }

    private function guardAgainstInvalidBuildingType(string $buildingType): void
    {
        if (!in_array($buildingType, BuildingType::$buildingTypes, true)) {
            throw new GameException('You cannot upgrade that building type.');
        }
    }
}
