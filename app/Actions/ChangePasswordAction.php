<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\Character;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction
{
    public function __invoke(User $user, $newPassword, $newPasswordConfirmation, $oldPassword): void
    {
        $this->guardAgainstInvalidHash($user->password, $newPassword);

        $user->password = Hash::make($newPassword);
        $user->save();

    }

    private function guardAgainstInvalidHash($passwordHash, $enteredPassword)
    {
        if (!Hash::check($enteredPassword, $passwordHash)) {
            throw new GameException('Incorrect Current Password');
        }
    }
}
