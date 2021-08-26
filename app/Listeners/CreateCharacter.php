<?php

namespace App\Listeners;

use App\Factories\CharacterFactory;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;

class CreateCharacter
{
    public function __construct(
        private CharacterFactory $factory,
    )
    {
    }

//    public function handle(Verified $event): void
    public function handle(Registered $event): void
    {
        /** @var User $user */
        $user = $event->user;

        $this->factory->createForUser($user);
    }
}
