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

        switch ($character->status) {
            case CharacterStatus::FREE:
                // no op
                break;

            case CharacterStatus::TRAVELLING:
                if (!$request->routeIs('character.travelling')) {
                    return redirect()->route('character.travelling');
                }
                break;

            case CharacterStatus::BATTLING:
                // todo
                break;

            case CharacterStatus::DEAD:
                // todo
                break;
        }

        return $next($request);
    }
}
