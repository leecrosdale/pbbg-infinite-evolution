<?php

namespace App\Http\Controllers;

use App\Actions\TrainingAction;
use App\Exceptions\GameException;
use App\Models\Character;
use Illuminate\Http\Request;

class TrainingController extends Controller
{

    public function index()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        return view('pages.training', compact('character'));
    }

    public function perform(Request $request, TrainingAction $action)
    {

        /** @var Character $character */
        $character = auth()->user()->character;

        $energy = (int)$request->input('energy');
        $type = $request->input('type');

        try {
            $action($character, $type, $energy);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('character.training');
    }
}
