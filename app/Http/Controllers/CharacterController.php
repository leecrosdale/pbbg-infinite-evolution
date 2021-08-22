<?php

namespace App\Http\Controllers;

use App\Models\Character;

class CharacterController extends Controller
{
    // todo: rename to StatusController?

    public function travelling()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        if ($character->status_free_at !== null) {
            $secondsRemaining = ($character->status_free_at->getTimestamp() - now()->getTimestamp());
        }

        // todo

        return view('pages.status.travelling', compact('character'));
    }

    public function training()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        return view('pages.status.training', compact('character'));
    }
}
