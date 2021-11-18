@extends('layouts.app')

@section('description')
    <p>The dashboard page shows most other players at your current location, as well as the latest update news.</p>
    <p>Criteria for some players not showing up: Low health, or busy training / travelling.</p>
    <p class="mb-0">
        <a href="https://discord.gg/ZsgDSdWF7f" target="_blank">
            <img src="{{ asset('img/discord.png') }}" alt="Join the Discord!" class="img-fluid">
        </a>
    </p>

@endsection

@section('content')
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-12 col-lg-6">
            <h2>Players</h2>

            @if ($otherCharacters->count() > 0)
                <x-card class="mb-4">
                    <x-slot name="bodyClass">p-0 table-responsive</x-slot>

                    <table class="table table-hover mb-0">
                        <thead class="text-white bg-secondary">
                            <tr>
                                <th>Player</th>
                                <th class="text-right">Est. Strength</th>
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
                                    <td class="text-right">
                                        @php($relativeStrength = ($otherCharacter->getPower() / $character->getPower()) * 100)

                                        @if ($relativeStrength < 75)
                                            Weak
                                        @elseif ($relativeStrength > 125)
                                            Strong
                                        @else
                                            Equal
                                        @endif
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
                <p class="my-4 text-xl">You don't see any other players here at {{ $location->name }}.</p>
            @endif
        </div>
        <div class="col-12 col-lg-6">
            <h2>News</h2>

            <x-card class="mb-4" header="Update: November 18th, 2021">
                <p>Changes</p>
                <ul>
                    <li>Added Experience to the right hand section.</li>
                    <li>Moved Level / Location text for a slightly better layout.</li>
                    <li>Training now has fixed energy usage for light/average/heavy - no more selectable range</li>
                    <li>Buildings in higher evolution locations will cost more to build but will give more resource for each work action</li>
                </ul>
                <p>Fixes</p>
                <ul class="mb-0">
                    <li></li>
                </ul>
            </x-card>

            <x-card class="mb-4" header="Update: August 29th, 2021">
                <p>Changes</p>
                <ul>
                    <li>Reduced experience gain from successful attacks.</li>
                </ul>
                <p>Fixes</p>
                <ul class="mb-0">
                    <li>Fix previous evolution-tier items not being craftable.</li>
                </ul>
            </x-card>
        </div>
    </div>


@endsection
