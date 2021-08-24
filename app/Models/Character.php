<?php

namespace App\Models;

use App\Enums\CharacterStatType;

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

        // Check if we're eligible to evolve
        $newEvolution = Evolution::query()
            ->where('order', '>', $this->evolution->order)
            ->where('experience_required', '<', $this->experience)
            ->orderBy('order')
            ->first();

        if ($newEvolution !== null) {
            $this->evolution()->associate($newEvolution);
            session()->flash(
                'evolveStatus',
                ("You evolved into the {$newEvolution->name} because you crossed " . number_format($newEvolution->experience_required) . " total experience."),
            );
        }

        // Check if we're eligible to level up
        // todo
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
        return $this->items()
                ->wherePivot('qty', '>=', $qty)
                ->where('id', $item->id)
                ->count() > 0;
    }

    public function hasItemTypeEquipped(Item $item)
    {
        return $this->items()
            ->where('type', $item->type)
            ->wherePivot('equipped', true)
            ->exists();
    }

    public function getEquippedItemType(string $itemType): ?Item
    {
        return $this->items()
            ->where('type', $itemType)
            ->wherePivot('equipped', true)
            ->first();
    }

    public function getEquippedItems()
    {
        return $this->items()
            ->wherePivot('equipped', true)
            ->get();
    }

    public function getEquippedItemBuffsByStatType(string $statType)
    {
        $equippedItems = $this->getEquippedItems();

        $buff = 0;

        foreach ($equippedItems as $item) {
            if ($item->buffs === null) {
                continue;
            }

            foreach ($item->buffs as $buffKey => $buffValue) {
                if ($buffKey !== $statType) {
                    continue;
                }

                if ($buffValue > 0) {
                    $buff += $buffValue;
                } else {
                    $buff -= $buffValue;
                }
            }
        }

        return $buff;
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

    public function getTotalAttackAttribute(): int
    {
        // Get all equipped attack buffs
        $buff = $this->getEquippedItemBuffsByStatType(CharacterStatType::ATTACK);

        return $this->stat_attack + $buff;
    }

    public function getTotalDefenceAttribute(): int
    {
        // Get all equipped defence buffs
        $buff = $this->getEquippedItemBuffsByStatType(CharacterStatType::DEFENCE);

        return $this->stat_defence + $buff;
    }
}
