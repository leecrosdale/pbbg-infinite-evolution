<?php

namespace App\Http\Controllers;

use App\Models\Character;

class CharacterController extends Controller
{
    public function travelling()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        return view('pages.status.travelling', compact('character'));
    }

    public function training()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        return view('pages.status.training', compact('character'));
    }


}
