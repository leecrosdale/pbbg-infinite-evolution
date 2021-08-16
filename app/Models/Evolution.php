<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evolution extends Model
{
    use HasFactory;

    protected $casts = [
        'requirements' => 'array',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
