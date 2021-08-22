<?php

namespace App\Actions;

use App\Calculator\WorkBuildingCalculator;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\CharacterBuilding;
use Illuminate\Support\Facades\DB;

class WorkBuildingAction
{
    use BuildingGuards;

    private Character $character;
    private string $buildingType;
    private CharacterBuilding $building;
    private int $energyCost;
    private array $supplyGains;

    public function __construct(
        private WorkBuildingCalculator $calculator,
    )
    {
    }

    public function __invoke(Character $character, string $buildingType): string
    {
        $this->character = $character;
        $this->buildingType = $buildingType;

        $this->guardAgainstInvalidBuildingType();

        $this->building = $character->getBuilding($this->buildingType);
        $this->guardAgainstNonConstructedBuilding();
        $this->guardAgainstWorkCooldown();

        $this->energyCost = $this->calculator->getEnergyCost($character, $buildingType);
        $this->guardAgainstInsufficientEnergy();

        DB::transaction(function () {
            $this->supplyGains = $this->calculator->getSupplyGains($this->buildingType);

            $this->character->energy -= $this->energyCost;

            foreach ($this->supplyGains as $supplyType => $amount) {
                $this->character->{"supply_{$supplyType}"} += $amount;
            }

            $this->character->save();

            $this->building->next_work_at = now()->addSeconds(
                $this->calculator->getNextWorkDelayInSeconds($this->character, $this->buildingType)
            );
            $this->building->save();
        });

        $buildingName = snake_case_to_words($this->buildingType);
        $gainedSuppliesString = [];
        foreach ($this->supplyGains as $supplyType => $amount) {
            $supplyName = snake_case_to_words($supplyType);
            $gainedSuppliesString[] = "{$amount} {$supplyName}";
        }
        $gainedSuppliesString = implode(', ', $gainedSuppliesString);

        return "You work at the {$buildingName} and gain {$gainedSuppliesString}.";
    }

    private function guardAgainstWorkCooldown(): void
    {
        if (($this->building->next_work_at !== null) && ($this->building->next_work_at > now())) {
            $buildingName = snake_case_to_words($this->buildingType);
            throw new GameException("You cannot work your {$buildingName} yet.");
        }
    }

    private function guardAgainstInsufficientEnergy(): void
    {
        if ($this->character->energy < $this->energyCost) {
            $buildingName = snake_case_to_words($this->buildingType);
            throw new GameException("You do not have enough energy to work your {$buildingName}.");
        }
    }
}
