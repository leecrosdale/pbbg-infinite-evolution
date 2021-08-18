<?php

namespace App\Http\Controllers;

use App\Models\Evolution;

class LocationController extends Controller
{
    public function index()
    {
        $evolutions = Evolution::query()
            ->with('locations.characters')
            ->get();

        return view('pages.location', compact('evolutions'));
    }
}
