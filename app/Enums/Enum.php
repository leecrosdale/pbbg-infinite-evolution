<?php

namespace App\Enums;

class Enum
{
    static function all(): array
    {
        $oClass = new \ReflectionClass(static::class);
        return $oClass->getConstants();
    }

    static function keyByValue($value)
    {
        $oClass = new \ReflectionClass(static::class);
        $constants = $oClass->getConstants();

        return array_search($value, $constants);
    }
}
