<?php

namespace App\Models;

use App\Enums\ItemType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'recipe' => 'object', // todo: array?
        'buffs' => 'object', // todo: array?
    ];

    public function evolution()
    {
        return $this->belongsTo(Evolution::class);
    }

    public function scopeBase($query)
    {
        $query->where('type', ItemType::BASE);
    }

    public function scopeCraftable($query)
    {
        $query->where('type', '!=', ItemType::BASE)
            ->where('type', '!=', ItemType::COLLECTIBLE);
    }

    public function getIsCraftableAttribute()
    {
        return (
            ($this->type !== ItemType::BASE)
            && ($this->type !== ItemType::COLLECTIBLE)
        );
    }

    public function getEquippableAttribute()
    {
        return ($this->type !== ItemType::BASE);
    }
}
