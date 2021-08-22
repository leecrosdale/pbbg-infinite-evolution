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

        $secondsRemaining = null;

        if ($character->status_free_at !== null) {
            $secondsRemaining = ($character->status_free_at->getTimestamp() - now()->getTimestamp());
        }

        return view('pages.status.travelling', compact('character', 'secondsRemaining'));
    }

    public function training()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        $secondsRemaining = null;

        if ($character->status_free_at !== null) {
            $secondsRemaining = ($character->status_free_at->getTimestamp() - now()->getTimestamp());
        }

        return view('pages.status.training', compact('character', 'secondsRemaining'));
    }
}
