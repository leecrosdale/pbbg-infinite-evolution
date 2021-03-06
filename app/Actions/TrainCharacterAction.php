<?php

namespace App\Actions;

use App\Calculator\TrainingCalculator;
use App\Enums\CharacterStatus;
use App\Enums\TrainingType;
use App\Exceptions\GameException;
use App\Models\Character;

class TrainCharacterAction
{
    public const MIN_ENERGY_TO_TRAIN = 5;

    public function __construct(
        private TrainingCalculator $trainingCalculator,
    )
    {
    }

    public function __invoke(Character $character, string $type, int $energy)
    {
        $this->guardAgainstInvalidTrainingType($type);
        $this->guardAgainstEnergyThreshold($energy);
        $this->guardAgainstInsufficientEnergy($character, $energy);

        $character->energy -= $energy;
        $character->save();

        $this->guardAgainstFailedTraining($type);

        $defenceSplit = $this->trainingCalculator->calculateEnergySplit($energy);
        $attackSplit = $energy - $defenceSplit;

        $character->stat_defence += $this->trainingCalculator->calculateStatGain($type, $defenceSplit);
        $character->stat_attack += $this->trainingCalculator->calculateStatGain($type, $attackSplit);

        $expGain = $this->trainingCalculator->calculateStatGain($type, $energy);

        // TODO not sure if this is correct, it will cause two save events, but we should try to calc levelling etc on the fly.
        $character->addExperience($expGain);

        $character->status = CharacterStatus::TRAINING;
        $character->status_free_at = now()->addSeconds(
            $this->trainingCalculator->getTrainingTimeInSeconds($energy)
        );

        $character->save();
    }

    private function guardAgainstFailedTraining(string $type) : void
    {
        if (!$this->trainingCalculator->isTrainingSuccessful($type)) {
            throw new GameException("You just couldn't get into it - Training failed.");
        }
    }

    private function guardAgainstInvalidTrainingType(string $type): void
    {
        if (!in_array($type, TrainingType::$trainingTypes, true)) {
            throw new GameException('Invalid training type');
        }
    }

    private function guardAgainstEnergyThreshold(int $energy): void
    {
        if ($energy < static::MIN_ENERGY_TO_TRAIN) {
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
