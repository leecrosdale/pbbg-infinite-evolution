<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function evolution()
    {
        return $this->belongsTo(Evolution::class);
    }

    public function getEnergyRequiredAttribute()
    {
        return $this->calculateRequiredEnergy(auth()->user()->character, $this);
    }

    public function getSecondsRequiredAttribute()
    {
        return $this->calculateTravelSeconds(auth()->user()->character, $this);
    }

    public function calculateTravelSeconds(Character $character, Location $destination)
    {
       return $this->calculateRequiredEnergy($character, $destination) * config('locations.seconds_per_energy');
    }

    public function calculateRequiredEnergy(Character $character, Location $destination)
    {

        // TODO Not sure if we should be doing some weird triangulation or simply just come up with some sort of "cost"
        // Not sure on the CPU cost of doing some hypotenuse function or something?

        $currentLocation = $character->location;

        $x1 = $currentLocation->x;
        $y1 = $currentLocation->y;

        $x2 = $destination->x;
        $y2 = $destination->y;

        $costX = $x1 - $x2;
        $costY = $y1 - $y2;

        $cost = $costX + $costY;

        return $cost > 0 ? $cost : $cost * -1;

    }

}
