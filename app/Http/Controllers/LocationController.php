<?php

namespace App\Http\Controllers;

use App\Actions\TravelAction;
use App\Calculator\AttackCharacterCalculator;
use App\Calculator\TravelCalculator;
use App\Enums\CharacterStatus;
use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\Evolution;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        $evolutions = Evolution::query()
            ->where('order', '<=', $character->evolution->order)
            ->with('locations.characters')
            ->with('locations.buildings')
            ->orderByDesc('order')
            ->orderBy('name')
            ->get();

        return view('pages.locations', compact(
            'evolutions',
        ))
            ->with([
                'travelCalculator' => app(TravelCalculator::class),
            ]);
    }

    public function travel(Location $location, TravelAction $action)
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        try {
            $action($character, $location);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('character.travelling');
    }
}
