<?php

namespace App\Models;

class CharacterBuilding extends Model
{
    protected $dates = [
        'work_started_at',
        'next_work_at',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getHealthPercentage(): int
    {
        return (int)floor(min(
            (($this->health / $this->max_health) * 100),
            100
        ));
    }
}
