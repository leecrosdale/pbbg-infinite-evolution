<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DeleteAccountAction
{
    public function __invoke(User $user, $password): string
    {
        $this->guardAgainstInvalidHash($user->password, $password);

        $user->characters()->delete();
        $user->delete();

        return "Your account has been deleted";
    }

    private function guardAgainstInvalidHash($passwordHash, $enteredPassword)
    {
        if (!Hash::check($enteredPassword, $passwordHash)) {
            throw new GameException('Incorrect Current Password');
        }
    }
}
