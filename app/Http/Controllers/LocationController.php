<?php

namespace App\Http\Controllers;

use App\Enums\CharacterStatus;
use App\Models\Evolution;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $evolutions = Evolution::query()
            ->with('locations.characters')
            ->get();

        return view('pages.location', compact('evolutions'));
    }


    // Move the character a new location
    public function travel(Location $location)
    {

        $character = auth()->user()->character;

        if ($location->energy_required > $character->energy)
        {
            return redirect()->back()->withErrors(['energy' => 'You do not have enough energy to travel']);
        }

        if ($location->evolution->order > $character->evolution->order)
        {
            return redirect()->back()->withErrors(['evolution' => 'You do not have the required evolution to travel here']);
        }

        $character->travelTo($location);

        return redirect()->route('character.travelling');


    }

}
