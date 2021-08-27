<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\DB;

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

        $character = auth()->user()->character;

        $characterRank = DB::table('characters')
            ->select(DB::raw('FIND_IN_SET(experience, (SELECT GROUP_CONCAT(DISTINCT experience ORDER BY experience DESC) FROM characters))'))
            ->where('id', $character->id)
            ->first();

        $characterRank = current($characterRank);

        $totalPlayers = Character::count();

        return view('pages.leaderboard', compact(
            'topCharacters',
            'characterRank',
            'totalPlayers',
        ));
    }
}
