<?php

namespace App\Actions;

use App\Calculator\WorkBuildingCalculator;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\CharacterBuilding;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class WorkBuildingAction
{
    use BuildingGuards;
    use EnergyGuards;
    use SupplyGuards;

    public function __construct(
        private WorkBuildingCalculator $calculator,
    )
    {
    }

    public function __invoke(Character $character, string $buildingType): string
    {
        $this->guardAgainstInvalidBuildingType($buildingType);

        $building = $character->getBuilding($buildingType);
        $this->guardAgainstNonConstructedBuilding($character, $building, $buildingType);

        $energyCost = $this->calculator->getEnergyCost($character, $buildingType);
        $this->guardAgainstInsufficientEnergy($character, $energyCost);

        /** @noinspection NullPointerExceptionInspection */
        $this->guardAgainstWorkCooldown($building);

        DB::transaction(function () use ($character, $buildingType, $building, $energyCost, &$supplyGains) {
            $character->energy -= $energyCost;
            $character->addExperience($energyCost);
            $character->save();

            $supplyGains = $this->calculator->getSupplyGains($buildingType);

            foreach ($supplyGains as $supplyType => $amount) {
                /** @var Item $itemType */
                $itemType = Item::query()
                    ->where('name', snake_case_to_words($supplyType)) // todo: I don't like this :( need slug or other identifier or sth
                    ->firstOrFail();

                if ($character->hasItem($itemType)) {
                    $characterItem = $character->items()
                        ->where('name', snake_case_to_words($supplyType))
                        ->firstOrFail();

                    $character->items()->updateExistingPivot($itemType, [
                        'qty' => $characterItem->pivot->qty + $amount,
                    ]);
                } else {
                    $character->items()->attach($itemType, [
                        'qty' => $amount,
                    ]);
                }
            }

            $building->next_work_at = now()->addSeconds(
                $this->calculator->getCooldownInSeconds($character, $buildingType)
            );

            $building->save();
        });

        $buildingName = snake_case_to_words($buildingType);
        $gainedSuppliesString = [];
        foreach ($supplyGains as $supplyType => $amount) {
            $supplyName = snake_case_to_words($supplyType);
            $gainedSuppliesString[] = "{$amount} {$supplyName}";
        }
        $gainedSuppliesString = implode(', ', $gainedSuppliesString);

        return "You work at the {$buildingName} and gain {$gainedSuppliesString}.";
    }

    private function guardAgainstWorkCooldown(CharacterBuilding $building): void
    {
        if (($building->next_work_at !== null) && ($building->next_work_at > now())) {
            $buildingName = snake_case_to_words($building->type);
            throw new GameException("You cannot work your {$buildingName} yet.");
        }
    }
}
