<?php

namespace App\Calculator;

use App\Enums\TrainingType;
use App\Models\Character;
use JetBrains\PhpStorm\Pure;

class TrainingCalculator
{
    private const SECONDS_PER_ENERGY = 5;

    private const LIGHT_TRAINING_RISK = 0.95;
    private const AVERAGE_TRAINING_RISK = 0.85;
    private const HEAVY_TRAINING_RISK = 0.75;

    private const LIGHT_TRAINING_INCREASE = 0.5;
    private const AVERGAGE_TRAINING_INCREASE = 0.6;
    private const HEAVY_TRAINING_INCREASE = 0.7;


    public function calculateStatGain($type, $energy): int
    {
        switch ($type) {
            case TrainingType::LIGHT:
                $gain = round($energy * self::LIGHT_TRAINING_INCREASE);
                break;
            case TrainingType::AVERAGE:
                $gain = round($energy * self::AVERGAGE_TRAINING_INCREASE);
                break;

            case TrainingType::HEAVY:
                $gain = round($energy * self::HEAVY_TRAINING_INCREASE);
                break;
        }

        return $gain;
    }

    public function checkTrainingFailed($type, $energy): bool
    {
        switch ($type) {
            case TrainingType::LIGHT:
                return rand(0, 10) / 10 > self::LIGHT_TRAINING_RISK;
            case TrainingType::AVERAGE:
                return rand(0, 10) / 10 > self::AVERAGE_TRAINING_RISK;
            case TrainingType::HEAVY:
                return rand(0, 10) / 10 > self::HEAVY_TRAINING_RISK;
        }
    }

    public function calculateEnergySplit($energy): int
    {
        $percentageSplit = random_int(0, 100);
        return ($percentageSplit / 100) * $energy;
    }


    /**
     * Returns the training time in seconds from $energy usage
     *
     * @param Character $character
     * @param int $energy
     * @return int
     */
    #[Pure]
    public function getTrainingTimeInSeconds(int $energy): int
    {
        return ($energy * static::SECONDS_PER_ENERGY);
    }
}
