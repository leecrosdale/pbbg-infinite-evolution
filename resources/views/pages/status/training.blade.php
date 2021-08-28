@extends('layouts.app')

@section('content')
    <x-card header="Training" class="mb-3">
        @if ($character->status === \App\Enums\CharacterStatus::TRAINING)
            <p class="mb-0">You are currently training and will finish in <timer-component seconds="{{ $secondsRemaining }}" reload-on-finish="true">0</timer-component> seconds.</p>
        @else
            <p>You have completed your training.</p>
            <p class="mb-0">
                <a href="{{ route('buildings') }}" class="btn btn-success">Go Back</a>
            </p>
        @endif
    </x-card>
@endsection
