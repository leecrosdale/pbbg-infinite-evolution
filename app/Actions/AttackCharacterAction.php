<?php

namespace App\Actions;

use App\Calculator\AttackCharacterCalculator;
use App\Exceptions\GameException;
use App\Models\Character;

class AttackCharacterAction
{

    use EnergyGuards;

    public const ATTACK_ENERGY_COST = 15;
    public const DAMAGE_MULTIPLIER = 10;

    public function __construct(
        private AttackCharacterCalculator $calculator
    )
    {
    }

    public function __invoke(Character $attackingCharacter, Character $defendingCharacter): string
    {
        $this->guardAgainstInsufficientEnergy($attackingCharacter, static::ATTACK_ENERGY_COST);

        $attackingAttack = $attackingCharacter->total_attack;
        $defendingDefence = $defendingCharacter->total_defence;

        $damage = ($attackingAttack - $defendingDefence) * static::DAMAGE_MULTIPLIER;

        if ($damage < 0) {

            $damage = abs($damage);

            $attackingCharacter->health = $this->calculator->calculateRemainingHealth($attackingCharacter, $damage / 10); // Attempted to nerf return damage
            $attackingCharacter->save();

            throw new GameException("You attack {$defendingCharacter->name} but they overpower you and deal {$damage} damage.");

        } else if ($damage > 0) {

            $defendingCharacter->health = $this->calculator->calculateRemainingHealth($defendingCharacter, $damage);
            $defendingCharacter->save();

            $response = "You attack {$defendingCharacter->name} and deal {$damage} damage.";

            if ($defendingCharacter->health === 0) {
                $response .= ' They die!';
            }

            $building = $defendingCharacter->buildings()->where('location_id', $defendingCharacter->location_id)->get()->random(1)->first();

            if ($building) {

                $buildingDamage = $damage / 20;
                $building->health = $this->calculator->calculateRemainingBuildingHealth($building, $buildingDamage);

                $buildingName = snake_case_to_words($building->type);
                $response .= "You have also damaged their {$buildingName} for {$buildingDamage} damage";

                if ($building->health === 0) {
                    $response .=  " and disabled it!";
                }

                $building->save();

            }

            $attackingCharacter->energy -= self::ATTACK_ENERGY_COST;
            $attackingCharacter->addExperience($damage);
            $attackingCharacter->save();

            return $response;

        }

        throw new GameException("You attack {$defendingCharacter->name} and deal zero damage.");

    }
}
