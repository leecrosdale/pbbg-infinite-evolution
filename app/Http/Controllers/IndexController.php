<?php

namespace App\Http\Controllers;

class IndexController
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.index');
    }
}
