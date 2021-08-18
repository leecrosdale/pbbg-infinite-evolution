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
}
