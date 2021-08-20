<?php

namespace App\Http\Controllers;

use App\Actions\TrainingAction;
use App\Exceptions\GameException;
use App\Http\Requests\TrainingActionRequest;
use App\Models\Character;

class TrainingController extends Controller
{
    public function index()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        return view('pages.training', compact('character'));
    }

    public function perform(TrainingActionRequest $request, TrainingAction $action)
    {
        /** @var Character $character */
        $character = auth()->user()->character;
        $type = $request->get('type');
        $energy = $request->get('energy');

        try {
            $action($character, $type, $energy);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('character.training');
    }
}
