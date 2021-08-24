<?php

namespace App\Enums;

use ReflectionClass;

class Enum
{
    public static function all(): array
    {
        $class = new ReflectionClass(static::class);
        return $class->getConstants();
    }

//    public static function keyByValue($value): mixed
//    {
//        $constants = static::all();
//
//        return array_search($value, $constants, true);
//    }
}
