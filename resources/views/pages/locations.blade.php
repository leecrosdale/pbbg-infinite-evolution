@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach ($evolutions as $evolution)
            <div class="col-12 col-md-6">

                <h2>{{ $evolution->name }}</h2>

                @foreach ($evolution->locations as $location)
                    <x-card class="mb-3">

                        <x-slot name="header">
                            {{ $location->name }}
                            @if ($character->location->id !== $location->id)
                                - <a href="{{ route('locations.travel', $location) }}">Travel</a>
                                ({{ number_format($travelCalculator->getEnergyCost($character, $location)) }} energy, {{ number_format($travelCalculator->getTravelTimeInSeconds($character, $location)) }} seconds)
                            @endif
                        </x-slot>

                        @if ($location->characters->count() === 0)
                            No characters detected.
                        @else
                            <x-slot name="bodyClass">p-0 table-responsive</x-slot>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Character</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($location->characters as $locationCharacter)
                                        <tr>
                                            <td class="align-middle">
                                                {{ $locationCharacter->name }}
                                                @if ($locationCharacter->id === $character->id)
                                                    <span class="badge badge-primary">You</span>
                                                @endif
                                            </td>
                                            <td class="text-right align-middle">
                                                @if ($locationCharacter->id !== $character->id)
                                                    <a href="#" class="btn btn-sm btn-primary">Message</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Attack</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </x-card>
                @endforeach

            </div>
        @endforeach
    </div>
@endsection
