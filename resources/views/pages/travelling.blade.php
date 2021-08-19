@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-12">
                <x-card header="Travelling" class="mb-3">
                    @if ($character->status === \App\Enums\CharacterStatus::TRAVELLING)
                        You are currently travelling to {{ $location->name }} and will arrive in <span id="arrival_seconds">{{ $character->status_free_at?->getTimestamp() - now()->getTimestamp() }}</span> seconds.
                    @else
                        <p>You have arrived at {{ $location->name }}.</p>
                        <p class="mb-0">
                            <a href="{{ route('dashboard') }}" class="btn btn-success">View Location</a>
                        </p>
                    @endif
                </x-card>
            </div>

        </div>
    </div>
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
