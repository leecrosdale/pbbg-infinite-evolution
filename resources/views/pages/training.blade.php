@extends('layouts.app')

@section('description')
    <p>The training page allows you to spend energy to train your attack and defence.</p>
    <p class="mb-0">The amount gained each stat depends on energy spent, the training type, and a bit of RNG.</p>
@endsection

@section('content')
    <h1>Training</h1>

    <x-card class="mb-4">
        <p>Light training will have a higher chance of success, but will yield worse results.</p>
        <p>Heavy training will yield better results but has a much higher chance of failure.</p>

        @if ($character->energy >= \App\Actions\TrainCharacterAction::MIN_ENERGY_TO_TRAIN)
            <form method="post" action="{{ route('training.perform') }}">
                @csrf
                <span id="value">Using {{ $character->energy }} energy will take {{ $character->energy * \App\Calculator\TrainingCalculator::SECONDS_PER_ENERGY }} seconds to train</span>

                <input type="range" min="{{ \App\Actions\TrainCharacterAction::MIN_ENERGY_TO_TRAIN }}" class="form-control" max="{{ $character->energy }}" value="{{ $character->energy }}" onchange="onChange(this.value)" name="energy">

                <div class="row">
                    <div class="col-4">
                        <button type="submit" name="type" value="light" class="btn btn-block btn-success">Light Training</button>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="type" value="average" class="btn btn-block btn-primary">Average Training</button>
                    </div>
                    <div class="col-4">
                        <button type="submit" name="type" value="heavy" class="btn btn-block btn-danger">Heavy Training</button>
                    </div>
                </div>
            </form>
        @else
            <p>You need more than {{ \App\Actions\TrainCharacterAction::MIN_ENERGY_TO_TRAIN }} energy to train!</p>
        @endif

    </x-card>
@endsection

@push('scripts')
    <script>
        let secondsPerEnergy = {{ \App\Calculator\TrainingCalculator::SECONDS_PER_ENERGY }};

        function onChange(value) {
            $('#value').text('Using ' + value + ' energy will take ' + value*secondsPerEnergy + ' seconds to train');
        }
    </script>
@endpush
