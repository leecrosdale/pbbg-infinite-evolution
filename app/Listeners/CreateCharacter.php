<?php

namespace App\Listeners;

use App\Factories\CharacterFactory;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class CreateCharacter
{
    public function __construct(
        private CharacterFactory $factory
    )
    {
    }

    public function handle(Registered $event): void
    {
        /** @var User $user */
        $user = $event->user;

        $this->factory->createForUser($user);
    }
}
