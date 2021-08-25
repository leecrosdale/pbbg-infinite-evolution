<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    private ?User $user = null;

    public function boot()
    {

        View::composer('*', function () {
            if (auth()->guest() || auth()->user()->email_verified_at === null) {
                return;
            }

            if ($this->user === null) {
                $this->user = auth()->user();

                $this->user->load([
                    'character.location',
                    'character.items',
                    'character.evolution',
                ]);
            }

            View::share('user', $this->user);
            View::share('character', $this->user->character);
            View::share('location', $this->user->character->location);
        });
    }
}
