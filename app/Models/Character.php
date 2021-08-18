<?php

namespace App\Models;

class Character extends Model
{
    public function buildings()
    {
        return $this->hasMany(CharacterBuilding::class);
    }

//    public function clan()
//    {
//        return $this->belongsTo(Clan::class);
//    }

    public function evolution()
    {
        return $this->belongsTo(Evolution::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHealthPercentageAttribute(): float
    {
        return min(
            (($this->health / $this->max_health) * 100),
            100
        );
    }

    public function getEnergyPercentageAttribute(): float
    {
        return min(
            (($this->energy / $this->max_energy) * 100),
            100
        );
    }
}
