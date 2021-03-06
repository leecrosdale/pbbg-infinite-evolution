<?php

namespace App\Actions;

use App\Exceptions\GameException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction
{
    public function __invoke(User $user, $newPassword, $newPasswordConfirmation, $oldPassword): string
    {
        $this->guardAgainstInvalidHash($user->password, $oldPassword);

        $user->password = Hash::make($newPassword);
        $user->save();

        return 'Password has been changed';
    }

    private function guardAgainstInvalidHash($passwordHash, $enteredPassword)
    {
        if (!Hash::check($enteredPassword, $passwordHash)) {
            throw new GameException('Incorrect Current Password');
        }
    }
}
