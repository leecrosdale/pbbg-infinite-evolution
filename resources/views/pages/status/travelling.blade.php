@extends('layouts.app')

@section('content')
    <x-card header="Travelling" class="mb-3">
        @if ($character->status === \App\Enums\CharacterStatus::TRAVELLING)
            You are currently travelling to {{ $location->name }} and will arrive in <span id="arrival_seconds">{{ $secondsRemaining }}</span> seconds.
        @else
            <p>You have arrived at {{ $location->name }}.</p>
            <p class="mb-0">
                <a href="{{ route('dashboard') }}" class="btn btn-success">View Location</a>
            </p>
        @endif
    </x-card>
@endsection

@push('scripts')
    <script>
        var secondsRemaining = {{ $secondsRemaining }};

        if (secondsRemaining > 0) {
            window.addEventListener('DOMContentLoaded', function() {
                window.setInterval(function () {
                    secondsRemaining--;

                    if (secondsRemaining < 0) {
                        location.reload();
                        return;
                    }

                    $('#arrival_seconds').text(secondsRemaining);
                }, 1000);
            });
        }
    </script>
@endpush
