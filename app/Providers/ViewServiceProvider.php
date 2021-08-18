<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function () {
            if (auth()->guest()) {
                return;
            }

            $user = auth()->user();

            View::share('user', $user);
            View::share('character', $user->character);
            View::share('location', $user->character->location);
        });
    }
}
