@extends('layouts.app')

@section('content')
    <x-card header="Travelling" class="mb-3">
        @if ($character->status === \App\Enums\CharacterStatus::TRAVELLING)
            <p class="mb-0">You are currently travelling to {{ $location->name }} and will arrive in <timer-component seconds="{{ $secondsRemaining }}" reload-on-finish="true">0</timer-component> seconds.</p>
        @else
            <p>You have arrived at {{ $location->name }}.</p>
            <p class="mb-0">
                <a href="{{ route('buildings') }}" class="btn btn-success">View Location</a>
            </p>
        @endif
    </x-card>
@endsection
