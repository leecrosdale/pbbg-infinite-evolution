<?php

namespace App\Http\Middleware;

use App\Enums\CharacterStatus;
use Closure;
use Illuminate\Http\Request;

class CheckCharacterStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->user()->character->status !== CharacterStatus::FREE)
        {
            switch ($request->user()->character->status)
            {
                case CharacterStatus::TRAVELLING:

                    if (!$request->user()->character->canBeFreed()) {
                        return redirect()->route('character.travelling');
                    }

                break;

            }

        }

        return $next($request);
    }
}
