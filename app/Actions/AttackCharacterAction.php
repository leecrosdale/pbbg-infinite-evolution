<?php

namespace App\Actions;

use App\Models\Character;

class AttackCharacterAction
{

    use EnergyGuards;

    public const ATTACK_ENERGY_COST = 15;

    public function __invoke(Character $attackingCharacter, Character $defendingCharacter): string
    {
        $this->guardAgainstInsufficientEnergy($attackingCharacter, static::ATTACK_ENERGY_COST);

        $attackingAttack = $attackingCharacter->total_attack;
        $defendingDefence = $attackingCharacter->total_defence;

        $damage = $attackingAttack - $defendingDefence;

        $attackingCharacter->energy -= self::ATTACK_ENERGY_COST;

        if ($damage < 0) {

            $attackingCharacter->health -= $damage;
            $attackingCharacter->save();

            return "You attack {$defendingCharacter->name} but they overpower you and deal {$damage} damage.";


        } else if ($damage > 0) {

            $defendingCharacter->health -= $damage;
            $defendingCharacter->save();

            return "You attack {$defendingCharacter->name} and deal {$damage} damage.";
        }


        return "You attack {$defendingCharacter->name} and deal no damage.";


    }
}
