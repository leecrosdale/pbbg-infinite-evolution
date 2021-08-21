<?php

namespace App\Http\Controllers;

use App\Models\Character;

class CharacterController extends Controller
{
    public function travelling()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        if ($character->status_free_at !== null) {
            $secondsRemaining = ($character->status_free_at->getTimestamp() - now()->getTimestamp());
        }

        return view('pages.travelling', compact('character'));
    }
}
