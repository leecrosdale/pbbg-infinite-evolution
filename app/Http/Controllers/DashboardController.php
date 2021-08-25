<?php

namespace App\Http\Controllers;

use App\Calculator\UpgradeBuildingCalculator;
use App\Calculator\WorkBuildingCalculator;
use App\Models\Character;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        $buildings = $character->buildings()
            ->where('location_id', $character->location_id)
            ->get();

        return view('pages.dashboard', compact(
            'buildings',
        ))->with([
            'upgradeBuildingCalculator' => app(UpgradeBuildingCalculator::class),
            'workBuildingCalculator' => app(WorkBuildingCalculator::class),
        ]);
    }
}
