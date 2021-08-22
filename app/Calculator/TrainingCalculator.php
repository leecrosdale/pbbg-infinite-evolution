<?php

namespace App\Calculator;

use App\Enums\TrainingType;
use JetBrains\PhpStorm\Pure;

class TrainingCalculator
{
    private const SECONDS_PER_ENERGY = 5;

    private const LIGHT_TRAINING_RISK = 0.95; // 5%
    private const LIGHT_TRAINING_INCREASE = 0.5;

    private const AVERAGE_TRAINING_RISK = 0.85; // 15%
    private const AVERAGE_TRAINING_INCREASE = 0.6;

    private const HEAVY_TRAINING_RISK = 0.75; // 25%
    private const HEAVY_TRAINING_INCREASE = 0.7;

    /**
     * Calculates the stats gained based on the $trainingType and $energy provided.
     *
     * @param string $trainingType
     * @param int $energy
     * @return int
     */
    #[Pure]
    public function calculateStatGain(string $trainingType, int $energy): int
    {
        return match ($trainingType) {
            TrainingType::LIGHT => round($energy * self::LIGHT_TRAINING_INCREASE),
            TrainingType::AVERAGE => round($energy * self::AVERAGE_TRAINING_INCREASE),
            TrainingType::HEAVY => round($energy * self::HEAVY_TRAINING_INCREASE),
        };
    }

    // todo: Move to TrainingAction sometime later.
    // Reliance on RNG isn't a pure calculation
    public function isTrainingSuccessful(string $trainingType): bool
    {
        $check = random_int(0, 100) / 100;

        return match ($trainingType) {
            TrainingType::LIGHT => ($check < self::LIGHT_TRAINING_RISK),
            TrainingType::AVERAGE => ($check < self::AVERAGE_TRAINING_RISK),
            TrainingType::HEAVY => ($check < self::HEAVY_TRAINING_RISK),
        };
    }

    // todo: move to action, see above
    public function calculateEnergySplit(int $energy): float
    {
        $percentageSplit = random_int(0, 100);
        return ($percentageSplit / 100) * $energy;
    }

    /**
     * Returns the training time in seconds from $energy usage.
     *
     * @param int $energy
     * @return int
     */
    #[Pure]
    public function getTrainingTimeInSeconds(int $energy): int
    {
        return ($energy * static::SECONDS_PER_ENERGY);
    }
}
