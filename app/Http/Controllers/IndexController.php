<?php

namespace App\Http\Controllers;

class IndexController
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('buildings');
        }

        return view('pages.index');
    }
}
