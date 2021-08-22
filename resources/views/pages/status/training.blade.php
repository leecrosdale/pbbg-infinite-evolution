@extends('layouts.app')

@section('content')
    <x-card header="Training" class="mb-3">
        @if ($character->status === \App\Enums\CharacterStatus::TRAINING)
            You are currently training and will finish in <span id="arrival_seconds">{{ $character->status_free_at?->getTimestamp() - now()->getTimestamp() }}</span> seconds.
        @else
            <p>You have completed your training.</p>
            <p class="mb-0">
                <a href="{{ route('dashboard') }}" class="btn btn-success">Go Back</a>
            </p>
        @endif
    </x-card>
@endsection

@push('scripts')
    <script>
        var secondsRemaining = {{ $character->status_free_at?->getTimestamp() - now()->getTimestamp() }};

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
