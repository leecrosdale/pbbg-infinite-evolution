<?php

namespace App\Actions;

use App\Enums\BuildingType;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\CharacterBuilding;

trait BuildingGuards
{
    private function guardAgainstInvalidBuildingType(string $buildingType): void
    {
        if (!in_array($buildingType, BuildingType::all(), true)) {
            throw new GameException('You cannot construct that building type.');
        }
    }

    private function guardAgainstAlreadyConstructedBuilding(Character $character, ?CharacterBuilding $building, string $buildingType): void
    {
        if ($building !== null) {
            $buildingName = snake_case_to_words($buildingType);
            throw new GameException("You already have a {$buildingName} at {$character->location->name}.");
        }
    }

    private function guardAgainstNonConstructedBuilding(Character $character, ?CharacterBuilding $building, string $buildingType): void
    {
        if ($building === null) {
            $buildingName = snake_case_to_words($buildingType);
            throw new GameException("You do not have constructed a {$buildingName} at {$character->location->name}.");
        }
    }

    private function guardAgainstCurrentlyWorkingBuilding(CharacterBuilding $building): void
    {
        if ($building->next_work_at > now()) {
            $buildingName = snake_case_to_words($building->type);
            throw new GameException("Your {$buildingName} is currently busy working.");
        }
    }
}
