<?php

namespace App\Models;

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

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot([
            'qty',
            'equipped',
        ]);
    }

//    public function roundsEnded()
//    {
//        return $this->hasMany(Round::class, 'ended_by');
//    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addExperience(int $experience): void
    {
        $this->experience += $experience;

        // TODO Evolve / Levelling logic here, or action?

//        $this->save();
    }

    public function addCollectible(Item $item)
    {
        $item->available = false;
        $item->save();

        $this->addItem($item);
    }

    public function addItem(Item $item)
    {
        $this->items()->attach($item->id, ['equipped' => false, 'qty' => 1]);
    }

    public function getItem(string $itemType): ?Item
    {
        return $this->items
            ->where('name', snake_case_to_words($itemType))
            ->first();
    }

    public function hasItem(Item $item)
    {
        return $this->items
            ->where('id', $item->id)
            ->count() > 0;
    }

    public function hasItemQty(Item $item, int $qty)
    {
        return $this->items
            ->where('qty', '>=', $qty)
            ->where('id', $item->id)
            ->count() > 0;
    }

    public function getBuilding(string $buildingType): ?CharacterBuilding
    {
        return $this->buildings()->where([
            'location_id' => $this->location->id,
            'type' => $buildingType,
        ])->first();
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
