<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    public function evolution(): BelongsTo
    {
        return $this->belongsTo(Evolution::class);
    }
}
