<?php

namespace App\Http\Controllers;

use App\Actions\ChangePasswordAction;
use App\Actions\DeleteAccountAction;
use App\Exceptions\GameException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('pages.auth.settings');
    }

    public function deleteAccount(Request $request, DeleteAccountAction $action)
    {
        $request->validate([
            'password' => 'required'
        ]);

        /** @var User $user */
        $user = auth()->user();
        $password = $request->password;

        try {
            $result = $action($user, $password);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return response()->back()->with(['status' => $result]);
    }

    public function changePassword(Request $request, ChangePasswordAction $action)
    {

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $newPassword = $request->password;
        $newPasswordConfirmation = $request->password_confirmation;
        $oldPassword = $request->current_password;

        try {

            $result = $action($user, $newPassword, $newPasswordConfirmation, $oldPassword);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }


        auth()->logout();

        return redirect()->back()->with(['status' => $result]);

    }


}
