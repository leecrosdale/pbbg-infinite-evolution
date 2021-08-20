<?php

namespace App\Actions;

use App\Enums\BuildingType;
use App\Exceptions\GameException;
use App\Models\Character;

class ConstructBuildingAction
{
    public function __invoke(Character $character, string $buildingType)
    {
        $this->guardAgainstInvalidBuildingType($buildingType);
        // ensure char doesnt have building already at their location
        // ensure construction costs are affordable

        // TODO: Implement __invoke() method.
    }

    private function guardAgainstInvalidBuildingType(string $buildingType): void
    {
        if (!in_array($buildingType, BuildingType::$buildingTypes, true)) {
            throw new GameException('You cannot construct that building type.');
        }
    }
}
