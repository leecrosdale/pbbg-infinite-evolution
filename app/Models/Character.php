<?php

namespace App\Models;

use App\Enums\CharacterStatus;

class Character extends Model
{

    protected $dates = [
        'status_free_at'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function travelTo(Location $location)
    {
        $this->energy -= $location->energy_required;
        $this->location_id = $location->id;
        $this->status = CharacterStatus::TRAVELLING;
        $this->status_free_at = now()->addSeconds($location->seconds_required);
        return $this->save();
    }

    public function canBeFreed()
    {
        if ($this->status_free_at < now())
        {
            $this->status_free_at = null;
            $this->status = CharacterStatus::FREE;
            $this->save();
            return true;
        }

        return false;
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

    public function getFreeTimeAttribute()
    {
        return $this->status_free_at->diffForHumans();
    }
}
