<?php

namespace App\Actions;

use App\Calculator\TrainingCalculator;
use App\Enums\CharacterStatus;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\Location;

class TrainingAction
{

    private $validTrainingTypes = [
        'light',
        'average',
        'heavy'
    ];

    public function __construct(
        private TrainingCalculator $trainingCalculator
    )
    {
    }

    public function __invoke(Character $character, string $type, int $energy)
    {
        $this->guardAgainstInvalidTrainingType($type);
        $this->guardAgainstLessThanFiveEnergy($energy);
        $this->guardAgainstInsufficientEnergy($character, $energy);

        $character->energy -= $energy;
        $character->save();

        $this->guardAgainstFailedTraining($type, $energy);

        $staminaSplit = $this->trainingCalculator->calculateEnergySplit($energy);
        $strengthSplit = $energy - $staminaSplit;

        $character->stat_stamina += $this->trainingCalculator->calculateStatGain($type,$staminaSplit);
        $character->stat_strength += $this->trainingCalculator->calculateStatGain($type, $strengthSplit);

        $expGain = $this->trainingCalculator->calculateStatGain($type, $energy);

        // TODO not sure if this is correct, it will cause two save events, but we should try to calc levelling etc on the fly.
        $character->addExperience($expGain);

        $character->status = CharacterStatus::TRAINING;
        $character->status_free_at = now()->addSeconds(
            $this->trainingCalculator->getTrainingTimeInSeconds($energy)
        );

        $character->save();
    }


    private function guardAgainstFailedTraining(string $type, int $energy) : void
    {
        if ($this->trainingCalculator->checkTrainingFailed($type, $energy)) {
            throw new GameException("You just couldn't get into it - Training failed.");
        }
    }

    private function guardAgainstInvalidTrainingType(string $type): void
    {
        if (!in_array($type, $this->validTrainingTypes)) {
            throw new GameException("Invalid training type");
        }
    }

    private function guardAgainstLessThanFiveEnergy(int $energy): void
    {
        if ($energy < 5) {
            throw new GameException("You must use 5 or more energy to train - you used {$energy}");
        }
    }

    private function guardAgainstInsufficientEnergy(Character $character, int $energy): void
    {
        if ($character->energy < $energy) {
            throw new GameException("You do not have enough energy ({$energy}) to train - you have {$character->energy}.");
        }
    }

}
