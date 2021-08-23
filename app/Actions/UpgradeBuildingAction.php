<?php

namespace App\Actions;

use App\Calculator\UpgradeBuildingCalculator;
use App\Models\Character;
use Illuminate\Support\Facades\DB;

class UpgradeBuildingAction
{
    use BuildingGuards;
    use EnergyGuards;
    use SupplyGuards;

    public function __construct(
        private UpgradeBuildingCalculator $calculator,
    )
    {
    }

    public function __invoke(Character $character, string $buildingType)
    {
        $this->guardAgainstInvalidBuildingType($buildingType);

        $building = $character->getBuilding($buildingType);
        $this->guardAgainstNonConstructedBuilding($character, $building, $buildingType);

        $energyCost = $this->calculator->getEnergyCost($character, $buildingType);
        $this->guardAgainstInsufficientEnergy($character, $energyCost);

        /** @noinspection NullPointerExceptionInspection */
        $supplyCosts = $this->calculator->getSupplyCosts($buildingType, $building);
        $this->guardAgainstInsufficientSupplies($character, $supplyCosts);

        DB::transaction(function () use ($character, $buildingType, $building, $energyCost, $supplyCosts) {
            $character->energy -= $energyCost;
            $character->addExperience($energyCost);

            foreach ($supplyCosts as $supplyType => $requiredAmount) {
                $characterItem = $character->items()
                    ->where('name', snake_case_to_words($supplyType))
                    ->firstOrFail();

                /** @noinspection NullPointerExceptionInspection */
                $character->items()->updateExistingPivot($characterItem, [
                    'qty' => $characterItem->pivot->qty - $requiredAmount,
                ]);
            }

            $character->save();

            $building->level++;
            $building->health += 100; // todo: calc
            $building->max_health += 100;
            $building->save();
        });

        $buildingName = snake_case_to_words($buildingType);
        return "You successfully upgrade your {$buildingName} at {$character->location->name} to level {$building->level}.";
    }
}
