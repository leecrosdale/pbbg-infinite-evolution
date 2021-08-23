<?php

namespace App\Http\Controllers;

use App\Actions\AttackCharacterAction;
use App\Exceptions\GameException;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function attack(Character $defendingCharacter, AttackCharacterAction $action)
    {
        /** @var Character $character */
        $attackingCharacter = auth()->user()->character;

        try {
            // todo: $result = $action and return as 'status' view var
            $result = $action($attackingCharacter, $defendingCharacter);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('locations')
            ->with(['status' => $result]);
    }
}
