<?php

namespace App\Models;

use App\Enums\CharacterStatus;

class Character extends Model
{
    protected $dates = [
        'status_free_at',
    ];

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

//    public function roundsEnded()
//    {
//        return $this->hasMany(Round::class, 'ended_by');
//    }

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
