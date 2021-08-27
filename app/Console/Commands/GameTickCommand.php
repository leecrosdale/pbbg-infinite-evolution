<?php

namespace App\Console\Commands;

use App\Models\Character;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GameTickCommand extends Command
{
    private const ENERGY_PER_TICK = 2;
    private const HEALTH_PERCENTAGE_PER_TICK = 1;

    protected $signature = 'game:tick';

    protected $description = 'Performs a game tick (every 5 mins)';

    public function handle()
    {
        DB::transaction(function () {
            $characters = Character::query()
                ->with('buildings')
                ->get();

            foreach ($characters as $character) {
                $character->energy = min(
                    $character->energy + static::ENERGY_PER_TICK,
                    $character->max_energy
                );

                $character->health = min(
                    $character->health + ($character->max_health / 100) * static::HEALTH_PERCENTAGE_PER_TICK,
                    $character->max_health
                );

                $character->save();

                foreach ($character->buildings as $building) {
                    $building->health = min(
                        $building->health + static::HEALTH_PERCENTAGE_PER_TICK,
                        $building->max_health
                    );

                    $building->save();
                }
            }
        });
    }
}
