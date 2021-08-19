<?php

namespace App\Http\Middleware;

use App\Enums\CharacterStatus;
use App\Models\Character;
use Closure;
use Illuminate\Http\Request;

class CheckCharacterStatus
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Character $character */
        $character = $request->user()->character;

        if ($character->status !== CharacterStatus::FREE) {
            switch ($character->status) {

                case CharacterStatus::TRAVELLING:
                    if (!$character->attemptFree()) {
                        return redirect()->route('character.travelling');
                    }
                    break;

            }
        }

        return $next($request);
    }
}
