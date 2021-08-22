<?php

namespace App\Http\Controllers;

use App\Actions\ConstructBuildingAction;
use App\Actions\UpgradeBuildingAction;
use App\Actions\WorkBuildingAction;
use App\Calculator\ConstructBuildingCalculator;
use App\Calculator\UpgradeBuildingCalculator;
use App\Calculator\WorkBuildingCalculator;
use App\Exceptions\GameException;
use App\Http\Requests\ConstructBuildingRequest;
use App\Http\Requests\UpgradeBuildingRequest;
use App\Http\Requests\WorkBuildingRequest;
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
                'workBuildingCalculator' => app(WorkBuildingCalculator::class),
            ]);
    }

    public function construct(ConstructBuildingRequest $request, ConstructBuildingAction $action)
    {
        /** @var Character $character */
        $character = auth()->user()->character;
        $buildingType = $request->get('building_type');

        try {
            $result = $action($character, $buildingType);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('buildings')
            ->with(['status' => $result]);
    }

    public function upgrade(UpgradeBuildingRequest $request, UpgradeBuildingAction $action)
    {
        /** @var Character $character */
        $character = auth()->user()->character;
        $buildingType = $request->get('building_type');

        try {
            $result = $action($character, $buildingType);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('buildings')
            ->with(['status' => $result]);
    }

    public function work(WorkBuildingRequest $request, WorkBuildingAction $action)
    {
        /** @var Character $character */
        $character = auth()->user()->character;
        $buildingType = $request->get('building_type');

        try {
            $result = $action($character, $buildingType);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('buildings')
            ->with(['status' => $result]);
    }
}
