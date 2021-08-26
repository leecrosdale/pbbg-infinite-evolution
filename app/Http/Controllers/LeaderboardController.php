<?php

namespace App\Http\Controllers;

use App\Models\Character;

class LeaderboardController
{
    public function index()
    {
        $topCharacters = Character::query()
            ->with('evolution')
            ->orderBy('experience', 'desc')
            ->limit(10)
            ->get();

        return view('pages.leaderboard', compact('topCharacters'));
    }
}
