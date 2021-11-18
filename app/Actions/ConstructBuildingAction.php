<?php

namespace App\Actions;

use App\Calculator\ConstructBuildingCalculator;
use App\Models\Character;
use Illuminate\Support\Facades\DB;

class ConstructBuildingAction
{
    use BuildingGuards;
    use EnergyGuards;
    use SupplyGuards;

    public function __construct(
        private ConstructBuildingCalculator $calculator,
    )
    {
    }

    public function __invoke(Character $character, string $buildingType): string
    {
        $this->guardAgainstInvalidBuildingType($buildingType);

        $building = $character->getBuilding($buildingType);
        $this->guardAgainstAlreadyConstructedBuilding($character, $building, $buildingType);

        $energyCost = $this->calculator->getEnergyCost($character->evolution, $buildingType);
        $this->guardAgainstInsufficientEnergy($character, $energyCost);

        $supplyCosts = $this->calculator->getSupplyCosts($buildingType);
        $this->guardAgainstInsufficientSupplies($character, $supplyCosts);

        DB::transaction(function () use ($character, $buildingType, $energyCost, $supplyCosts) {
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

            $character->buildings()->create([
                'location_id' => $character->location->id,
                'type' => $buildingType,
                'level' => 1,
                'health' => 100,
                'max_health' => 100,
            ]);
        });

        $buildingName = snake_case_to_words($buildingType);
        return "You construct a {$buildingName} at {$character->location->name}.";
    }
}
