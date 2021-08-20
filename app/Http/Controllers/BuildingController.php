<?php

namespace App\Http\Controllers;

use App\Actions\UpgradeBuildingAction;
use App\Http\Requests\ConstructBuildingActionRequest;
use App\Http\Requests\UpgradeBuildingActionRequest;
use App\Models\Character;

class BuildingController extends Controller
{
    public function index()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        $buildings = $character->buildings()
            ->where('location_id', $character->location_id)
            ->get();

        return view('pages.buildings', compact('buildings'));
    }

    public function construct(ConstructBuildingActionRequest $request, UpgradeBuildingAction $action)
    {
        $action();
    }

    public function upgrade(UpgradeBuildingActionRequest $request, UpgradeBuildingAction $action)
    {
        $action();
    }
}
