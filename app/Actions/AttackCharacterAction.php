<?php

namespace App\Actions;

use App\Calculator\AttackCharacterCalculator;
use App\Enums\ItemType;
use App\Exceptions\GameException;
use App\Models\Character;

class AttackCharacterAction
{
    use EnergyGuards;

    // todo: move to calc
    public const DAMAGE_MULTIPLIER = 1.5;

    public function __construct(
        private AttackCharacterCalculator $calculator
    )
    {
    }

    public function __invoke(Character $attackingCharacter, Character $defendingCharacter): string
    {
        $energyCost = $this->calculator->getEnergyCost($attackingCharacter);
        $this->guardAgainstInsufficientEnergy($attackingCharacter, $energyCost);

        if ($attackingCharacter->id === $defendingCharacter->id) {
            throw new GameException("You can't attack yourself!");
        }

        $attackingAttack = $attackingCharacter->total_attack;
        $defendingDefence = $defendingCharacter->total_defence;

        // todo: come up with better calc?
        $damage = ($attackingAttack - $defendingDefence) * static::DAMAGE_MULTIPLIER;

        $attackingCharacter->energy -= $energyCost;

        $xpGain = ($damage < 0)
            ? ceil(abs($damage) / 20)
            : ceil($damage / 5);

        $attackingCharacter->addExperience($xpGain);
        $attackingCharacter->save();

        if ($damage < 0) {
            $damage = (int)ceil(abs($damage) / 2);

            $attackingCharacter->health = $this->calculator->calculateRemainingHealth($attackingCharacter, $damage);
            $attackingCharacter->save();

            // todo: knock out yourself in retaliation

            throw new GameException("You attack {$defendingCharacter->name} but they overpower you and deal {$damage} damage to you.");

        } else if ($damage > 0) {
            $damage = (int)ceil($damage);

            $defendingCharacter->health = $this->calculator->calculateRemainingHealth($defendingCharacter, $damage);
            $defendingCharacter->save();

            $response = "You attack {$defendingCharacter->name} and deal {$damage} damage.";

            if ($defendingCharacter->health === 0) {
                $response .= ' You successfully knock them out!';
            }

            $building = $defendingCharacter->buildings()
                ->where('location_id', $defendingCharacter->location_id)
                ->inRandomOrder()
                ->first();

            if ($building !== null) {
                $buildingDamage = ceil($damage / 4);
                $building->health = $this->calculator->calculateRemainingBuildingHealth($building, $buildingDamage);

                $buildingName = snake_case_to_words($building->type);
                $response .= " You also damage their {$buildingName} for {$buildingDamage} damage";

                if ($building->health === 0) {
                    $response .= " and disabled it";
                }

                $response .= "!";
                $building->save();
            }

            if ($defendingCharacter->items()->where('type', ItemType::BASE)->exists()) {
                $baseItem = $defendingCharacter->items()
                    ->withPivot(['qty'])
                    ->where('type', ItemType::BASE)
                    ->inRandomOrder()
                    ->first();

                if ($baseItem) {
                    $stealQty = ceil($baseItem->pivot->qty * 0.05);
                    $response .= " You also stole {$stealQty} {$baseItem->name}!";
                    $attackingCharacter->updateItem($baseItem, $stealQty);
                }
            }

            return $response;
        }

        throw new GameException("You attack {$defendingCharacter->name} but they rival you in strength so you deal zero damage.");
    }
}
