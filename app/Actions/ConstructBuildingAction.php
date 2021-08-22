<?php

namespace App\Actions;

use App\Calculator\ConstructBuildingCalculator;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\CharacterBuilding;
use Illuminate\Support\Facades\DB;

class ConstructBuildingAction
{
    use BuildingGuards;

    private Character $character;
    private string $buildingType;
    private CharacterBuilding $building;
    private array $costs;

    public function __construct(
        private ConstructBuildingCalculator $calculator,
    )
    {
    }

    public function __invoke(Character $character, string $buildingType): string
    {
        $this->character = $character;
        $this->buildingType = $buildingType;

        $this->guardAgainstInvalidBuildingType();
        $this->guardAgainstAlreadyConstructedBuilding();

        $this->costs = $this->calculator->getSupplyCosts($buildingType);
        $this->guardAgainstUnaffordableConstructionCosts();

        DB::transaction(function () {
            foreach ($this->costs as $supplyType => $requiredAmount) {
                $this->character->{"supply_{$supplyType}"} -= $requiredAmount;
            }

            $this->character->save();

            $this->character->buildings()->create([
                'location_id' => $this->character->location->id,
                'type' => $this->buildingType,
                'level' => 1,
                'health' => 100,
                'max_health' => 100,
            ]);
        });

        $buildingName = snake_case_to_words($this->buildingType);
        return "You construct a {$buildingName} at {$this->character->location->name}.";
    }

    private function guardAgainstUnaffordableConstructionCosts(): void
    {
        foreach ($this->costs as $supplyType => $requiredAmount) {
            if ($this->character->{"supply_{$supplyType}"} < $requiredAmount) {
                $supplyName = snake_case_to_words($supplyType);
                $buildingName = snake_case_to_words($this->buildingType);
                throw new GameException("You do not have enough {$supplyName} to construct {$buildingName}.");
            }
        }
    }
}
