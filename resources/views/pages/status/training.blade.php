@extends('layouts.app')

@section('content')
    <h1>Training</h1>

    <x-card>
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
