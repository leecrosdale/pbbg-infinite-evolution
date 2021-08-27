<?php

namespace App\Http\Controllers;

use App\Models\Character;

class LeaderboardController
{
    public function index()
    {
        $topCharacters = Character::query()
            ->with([
                'location.evolution',
            ])
            ->orderBy('experience', 'desc')
            ->limit(10)
            ->get();

        $characterRank = 2;

        $totalPlayers = Character::count();

        return view('pages.leaderboard', compact(
            'topCharacters',
            'characterRank',
            'totalPlayers',
        ));
    }
}
