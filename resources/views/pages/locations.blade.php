@extends('layouts.app')

@section('content')
    <x-card header="{{ $location->name }}" class="mb-3">
        <p class="mb-0">You are currently at {{ $location->name }}.</p>

        {{--@if ($otherCharacters->count() > 0)
            <p class="mb-0">You see {{ number_format($otherCharacters->count()) }} other {{ Str::plural('player', $otherCharacters->count()) }} around you.</p>
        @endif--}}
    </x-card>

    @if ($otherCharacters->count() > 0)
        <x-card header="Other players at {{ $location->name }}" class="mb-3">
            <x-slot name="bodyClass">p-0 table-responsive</x-slot>

            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($otherCharacters as $otherCharacter)
                        <tr>
                            <td>
                                <div>{{ $otherCharacter->name }}</div>
                                <small class="text-secondary">Level {{ $otherCharacter->level }}</small>
                            </td>
                            <td>
                                <form action="#todo" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Attack
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    @endif

    <x-card header="Other locations" class="mb-3">
        <x-slot name="bodyClass">p-0 table-responsive</x-slot>

        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Available Work</th>
                    <th>Players</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evolutions as $evolution)
                    @foreach ($evolution->locations as $evolutionLocation)
                        <tr>
                            <td>
                                <div>
                                    {{ $evolutionLocation->name }}
                                    @if ($character->location->id === $evolutionLocation->id)
                                        <span class="badge badge-primary">You are here</span>
                                    @endif
                                </div>
                                <small class="text-secondary">{{ $evolution->name }}</small>
                            </td>
                            <td>
                                @foreach ($evolutionLocation->buildings->filter(fn($building) => $building->character_id === $character->id) as $building)
                                    @if ($building->next_work_at <= now())
                                        <span class="badge badge-secondary">{{ snake_case_to_words($building->type) }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $evolutionLocation->characters->count() }}</td>
                            <td>
                                @if ($character->location->id !== $evolutionLocation->id)
                                    @php($energyCost = $travelCalculator->getEnergyCost($character, $evolutionLocation))

                                    <form action="{{ route('locations.travel', $evolutionLocation) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-primary" {{ $energyCost > $character->energy ? 'disabled' : null }}>
                                            Travel
                                            ({{ number_format($energyCost) }}e, {{ number_format($travelCalculator->getTravelTimeInSeconds($character, $evolutionLocation)) }}s)
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </x-card>
@endsection
