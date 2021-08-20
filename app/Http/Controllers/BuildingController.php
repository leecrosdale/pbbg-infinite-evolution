<?php

namespace App\Http\Controllers;

use App\Actions\ConstructBuildingAction;
use App\Actions\UpgradeBuildingAction;
use App\Calculator\ConstructBuildingCalculator;
use App\Calculator\UpgradeBuildingCalculator;
use App\Exceptions\GameException;
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

        return view('pages.buildings', compact('buildings'))
            ->with([
                'constructBuildingCalculator' => app(ConstructBuildingCalculator::class),
                'upgradeBuildingCalculator' => app(UpgradeBuildingCalculator::class),
            ]);
    }

    public function construct(ConstructBuildingActionRequest $request, ConstructBuildingAction $action)
    {
        /** @var Character $character */
        $character = auth()->user()->character;
        $buildingType = $request->get('building_type');

        try {
            $action($character, $buildingType);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('buildings');
    }

    public function upgrade(UpgradeBuildingActionRequest $request, UpgradeBuildingAction $action)
    {
        /** @var Character $character */
        $character = auth()->user()->character;
        $buildingType = $request->get('building_type');

        try {
            $action($character, $buildingType);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('buildings');
    }
}
