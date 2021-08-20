<?php

namespace App\Http\Controllers;

use App\Models\Character;

class CharacterController extends Controller
{
    public function travelling()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        return view('pages.travelling', compact('character'));
    }
}
