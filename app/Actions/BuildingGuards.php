<?php

namespace App\Actions;

use App\Enums\BuildingType;
use App\Exceptions\GameException;

trait BuildingGuards
{
    private function guardAgainstInvalidBuildingType(): void
    {
        if (!in_array($this->buildingType, BuildingType::$buildingTypes, true)) {
            throw new GameException('You cannot construct that building type.');
        }
    }

    private function guardAgainstAlreadyConstructedBuilding(): void
    {
        if ($this->character->getBuilding($this->buildingType) !== null) {
            $buildingName = snake_case_to_words($this->buildingType);
            throw new GameException("You already have a {$buildingName} at {$this->character->location->name}.");
        }
    }

    private function guardAgainstNonConstructedBuilding(): void
    {
        if ($this->building === null) {
            $buildingName = snake_case_to_words($this->buildingType);
            throw new GameException("You do not have constructed a {$buildingName} at {$this->character->location->name}.");
        }
    }
}
