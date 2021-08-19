<?php

namespace App\Http\Controllers;

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
        if ($location->energy_required < auth()->user()->character->energy)
        {
            return redirect()->back()->withErrors(['energy' => 'You do not have enough energy to travel']);
        }

    }

}
