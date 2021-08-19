<?php

namespace App\Http\Controllers;

class CharacterController extends Controller
{
    public function travelling()
    {
        $character = auth()->user()->character;

        return view('pages.travelling', compact('character'));
    }
}
