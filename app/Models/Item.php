<?php

namespace App\Models;

use App\Enums\ItemType;
use App\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'recipe' => 'object',
        'buffs' => 'object'
    ];

    public function evolution()
    {
        return $this->belongsTo(Evolution::class);
    }

    public function scopeBase($query)
    {
        $query->where('type', ItemType::BASE);
    }

    public function getEquippableAttribute()
    {
        return $this->type !== ItemType::BASE;
    }

}
