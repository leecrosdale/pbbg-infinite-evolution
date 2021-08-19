<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function travelling()
    {
        return view('pages.travelling')->with('character', auth()->user()->character);
    }
}
