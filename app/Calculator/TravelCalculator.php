<?php

namespace App\Calculator;

use App\Models\Character;
use App\Models\Location;
use JetBrains\PhpStorm\Pure;

class TravelCalculator
{
    private const SECONDS_PER_ENERGY = 10;

    /**
     * Returns the cost in energy to travel to $destination location from where
     * the $character is.
     *
     * Returns null if the location is invalid.
     *
     * @param Character $character
     * @param Location $destination
     * @return int|null
     */
    #[Pure]
    public function getEnergyCost(Character $character, Location $destination): ?int
    {
        $source = $character->location;

        if ($source->id === $destination->id) {
            return null;
        }

        $x1 = $source->position_x;
        $y1 = $source->position_y;

        $x2 = $destination->position_x;
        $y2 = $destination->position_y;

        $costX = $x1 - $x2;
        $costY = $y1 - $y2;

        $cost = $costX + $costY;

        return abs($cost);
    }

    /**
     * Returns the travel time in seconds from $character location to
     * $destination location.
     *
     * @param Character $character
     * @param Location $destination
     * @return int
     */
    #[Pure]
    public function getTravelTimeInSeconds(Character $character, Location $destination): int
    {
        $energy = $this->getEnergyCost($character, $destination);
        return ($energy * static::SECONDS_PER_ENERGY);
    }
}
