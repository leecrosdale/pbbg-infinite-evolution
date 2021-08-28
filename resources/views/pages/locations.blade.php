@extends('layouts.app')

@section('description')
    <p>The locations page shows you other locations you can travel to.</p>
    <p class="mb-0">The work column shows your buildings in each location which can be worked at.</p>
@endsection

@section('content')
    <h1>Locations</h1>

    <x-card class="mb-4">
        <x-slot name="bodyClass">p-0 table-responsive</x-slot>

        <table class="table table-hover mb-0">
            <thead class="text-white bg-secondary">
                <tr>
                    <th>Location</th>
                    <th>Work</th>
                    <th class="text-right">Players</th>
                    <th width="130">Actions</th>
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
                            <td class="text-right">{{ $evolutionLocation->characters->count() }}</td>
                            <td>
                                @if ($character->location->id !== $evolutionLocation->id)
                                    @php($energyCost = $travelCalculator->getEnergyCost($character, $evolutionLocation))

                                    <form action="{{ route('locations.travel', $evolutionLocation) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-block btn-primary" {{ $energyCost > $character->energy ? 'disabled' : null }}>
                                            <div>Travel</div>
                                            <small class="d-flex justify-content-center">
                                                <div><i class="fas fa-bolt"></i> -{{ number_format($energyCost) }}</div>
                                                <span class="ml-3"><i class="fas fa-hourglass"></i> {{ number_format($travelCalculator->getTravelTimeInSeconds($character, $evolutionLocation)) }}</span>
                                            </small>
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
