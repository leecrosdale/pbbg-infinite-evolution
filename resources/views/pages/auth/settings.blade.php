@extends('layouts.app')

@section('description')
    <p class="mb-0">Your settings page allows you to change your password, or delete your account.</p>
@endsection

@section('content')
    <h1>Settings</h1>

    <x-card header="Change password" class="mb-4">
        <form method="POST" action="{{ route('settings.password') }}">
            @csrf

            <div class="form-group row">
                <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                <div class="col-md-6">
                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>

                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Change Password') }}
                    </button>
                </div>
            </div>
        </form>
    </x-card>

    <x-card header="Delete account" class="mb-4">
        <form method="POST" action="{{ route('settings.delete-account') }}">
            @csrf

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    <small class="form-text text-muted">Deleting your account is permanent and removes all associated data from our database. We cannot restore accounts.</small>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-danger">
                        Delete Account
                    </button>
                </div>
            </div>
        </form>
    </x-card>
@endsection
