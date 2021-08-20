<?php

namespace App\Enums;

class TrainingType
{
    public static array $trainingTypes = [
        self::LIGHT,
        self::AVERAGE,
        self::HEAVY,
    ];

    public const LIGHT = 'light';
    public const AVERAGE = 'average';
    public const HEAVY = 'heavy';
}
