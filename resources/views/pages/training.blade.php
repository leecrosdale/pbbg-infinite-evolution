@extends('layouts.app')

@section('content')
    <div class="col-12">
        <x-card class="mb-3">
            <x-slot name="header">
                Training
            </x-slot>

            <form method="post" action="{{ route('training.perform') }}">
                @csrf
                <span id="value">Energy Use: {{ $character->energy }}</span>
                <input type="range" min="5" class="form-control" max="{{ $character->energy }}" value="{{ $character->energy }}" onchange="onChange(this.value)" name="energy">
                <button type="submit" name="type" value="light" class="btn btn-primary">Light Training</button>
                <button type="submit" name="type" value="average" class="btn btn-warning">Average Training</button>
                <button type="submit" name="type" value="heavy" class="btn btn-danger">Heavy Training</button>
            </form>
        </x-card>
    </div>
@endsection

@push('scripts')
    <script>
        function onChange(value) {
            $('#value').text('Energy Use: ' + value);
        }
    </script>
@endpush
