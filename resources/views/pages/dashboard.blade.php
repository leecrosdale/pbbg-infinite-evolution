@extends('layouts.app')

@section('description')
    <p class="mb-0">The dashboard page currently lists other players at your current location.</p>
@endsection

@section('content')
    <h1>Dashboard</h1>

    @if ($otherCharacters->count() > 0)
        <x-card class="mb-4">
            <x-slot name="bodyClass">p-0 table-responsive</x-slot>

            <table class="table table-hover mb-0">
                <thead class="text-white bg-secondary">
                    <tr>
                        <th>Player</th>
                        <th width="130">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($otherCharacters as $otherCharacter)
                        <tr>
                            <td>
                                <div>
                                    <span class="font-weight-bold">{{ $otherCharacter->name }}</span>
                                </div>
                                <small class="text-muted">Level {{ number_format($otherCharacter->level) }}</small>
                            </td>
                            <td>
                                @php($energyCost = $attackCharacterCalculator->getEnergyCost($character))
                                <form action="{{ route('character.attack', $otherCharacter) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-block btn-danger" {{ $character->energy < $attackCharacterCalculator->getEnergyCost($character) ? 'disabled' : null }}>
                                        <div>Attack</div>
                                        <small class="d-flex justify-content-center">
                                            <div><i class="fas fa-bolt"></i> -{{ number_format($energyCost) }}</div>
                                        </small>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    @else
        <p class="my-4 text-xl">There are currently no other players here at {{ $location->name }}.</p>
    @endif
@endsection
