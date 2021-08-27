@extends('layouts.app')

@section('content')
    <x-card class="mb-0 mb-lg-4">
        <x-slot name="header">
            Training
        </x-slot>


        <p>You can train using as much energy as you like.</p>
        <p>Light training will have a higher chance of success, but will yield worse results.</p>
        <p>Heavy training will yield better results but has a much higher chance of failure.</p>

        @if ($character->energy >= \App\Actions\TrainCharacterAction::MIN_ENERGY_TO_TRAIN)


        <form method="post" action="{{ route('training.perform') }}">
            @csrf
            <span id="value">Energy Use: {{ $character->energy }}</span>



            <input type="range" min="{{ \App\Actions\TrainCharacterAction::MIN_ENERGY_TO_TRAIN }}" class="form-control" max="{{ $character->energy }}" value="{{ $character->energy }}" onchange="onChange(this.value)" name="energy">
            <button type="submit" name="type" value="light" class="btn btn-primary">Light Training</button>
            <button type="submit" name="type" value="average" class="btn btn-warning">Average Training</button>
            <button type="submit" name="type" value="heavy" class="btn btn-danger">Heavy Training</button>
        </form>

        @else
            You need more than {{ \App\Actions\TrainCharacterAction::MIN_ENERGY_TO_TRAIN }} energy to train!
        @endif

    </x-card>
@endsection

@push('scripts')
    <script>
        function onChange(value) {
            $('#value').text('Energy Use: ' + value);
        }
    </script>
@endpush
