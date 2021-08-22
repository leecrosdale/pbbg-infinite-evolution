<?php

namespace App\Models;

class CharacterBuilding extends Model
{
    protected $dates = [
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
}
