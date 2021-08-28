<?php

namespace App\Console\Commands;

use App\Models\Character;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OneMinuteTickCommand extends Command
{
    private const ENERGY_PER_TICK = 1;

    protected $signature = 'game:tick:minute';

    protected $description = 'Game tick: One minute interval';

    public function handle()
    {
        DB::transaction(function () {
            $characters = Character::query()
                ->get();

            foreach ($characters as $character) {
                $character->energy = min(
                    $character->energy + static::ENERGY_PER_TICK,
                    $character->max_energy
                );

                $character->save();
            }
        });
    }
}
