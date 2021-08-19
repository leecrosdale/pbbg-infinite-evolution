<?php

namespace App\Http\Middleware;

use App\Enums\CharacterStatus;
use App\Models\Character;
use Closure;
use Illuminate\Http\Request;

class AttemptFreeCharacterStatus
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

        if (($character->status !== CharacterStatus::FREE) && ($character->status_free_at <= now())) {
            $character->status_free_at = null;
            $character->status = CharacterStatus::FREE;
            $character->save();
        }

        return $next($request);
    }
}
