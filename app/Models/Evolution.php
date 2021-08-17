<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evolution extends Model
{
    use HasFactory;

    protected $casts = [
        'requirements' => 'array',
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
