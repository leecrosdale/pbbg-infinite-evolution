<?php

namespace App\Http\Controllers;

use App\Calculator\AttackCharacterCalculator;
use App\Enums\CharacterStatus;
use App\Models\Character;

class DashboardController
{
    public function index()
    {
        /** @var Character $character */
        $character = auth()->user()->character;

        $otherCharacters = $character->location
            ->characters
            ->filter(fn($otherCharacter) => $otherCharacter->id !== $character->id)
            ->filter(fn($otherCharacter) => (($otherCharacter->health / $otherCharacter->max_health) * 100) > 20) // show only other chars above 20% hp?
            ->filter(fn($otherCharacter) => (($otherCharacter->status_free_at === null) || ($otherCharacter->status_free_at <= now())));

        return view('pages.dashboard', compact(
            'otherCharacters',
        ))->with([
            'attackCharacterCalculator' => app(AttackCharacterCalculator::class),
        ]);
    }
}
