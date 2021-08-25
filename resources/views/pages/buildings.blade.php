@extends('layouts.app')

@section('content')

    <x-card header="Buildings at {{ $location->name }}" class="mb-4">
        @if ($buildings->count() === 0)
            No buildings constructed at {{ $location->name }}.
        @else
            <x-slot name="bodyClass">p-0 table-responsive</x-slot>

            <table class="table">
                <thead>
                    <tr>
                        <th>Building</th>
                        <th>Health</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buildings as $building)
                        <tr>
                            <td class="align-middle">
                                <div>{{ snake_case_to_words($building->type) }}</div>
                                <small class="text-secondary">Level {{ number_format($building->level) }}</small>
                            </td>
                            <td class="align-middle">
                                <div>
                                    {{ number_format($building->health) }}
                                    / {{ number_format($building->max_health) }}
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ ($building->health / $building->max_health) * 100 }}%;"></div>
                                </div>
                            </td>
                            <td class="text-right">
                                @php ($energyCostToWork = $workBuildingCalculator->getEnergyCost($character, $building->type))
                                <progress-timer-component start-time="{{ $building->work_started_at }}" current-time="{{ now() }}" end-time="{{ $building->next_work_at }}">
                                    <form action="{{ route('buildings.work') }}" method="POST" class="d-inline-block">
                                        @csrf

                                        <input type="hidden" name="building_type" value="{{ $building->type }}">
                                        <button type="submit" class="btn btn-sm btn-success" {{ $character->energy < $energyCostToWork ? 'disabled' : null }}>
                                            Work (-{{ number_format($energyCostToWork) }}e)
                                        </button>
                                    </form>

                                    <form action="{{ route('buildings.upgrade') }}" method="POST" class="d-inline-block">
                                        @csrf

                                        <input type="hidden" name="building_type" value="{{ $building->type }}">
                                        <button type="submit" class="btn btn-sm btn-primary" {{ !$upgradeBuildingCalculator->canAffordUpgrade($character, $building) ? 'disabled' : null }}>
                                            Upgrade (-{{ $upgradeBuildingCalculator->getEnergyCost($character, $building->type) }}e)
                                        </button>
                                    </form>

                                    <div>
                                        Upgrade:
                                        @foreach ($upgradeBuildingCalculator->getSupplyCosts($building->type, $building) as $supplyType => $requiredAmount)
                                            {{ number_format($requiredAmount) }}x {{ snake_case_to_words($supplyType) }}
                                        @endforeach
                                    </div>
                                </progress-timer-component>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </x-card>

    <div class="row mb-0 mb-lg-4">
        @foreach (\App\Enums\BuildingType::all() as $buildingType)
            @php($building = $character->getBuilding($buildingType))

            @if ($building !== null)
                @continue
            @endif

            <div class="col-12 col-md-4 col-lg-6 mb-4">
                <x-card header="{{ snake_case_to_words($buildingType) }}">
                    <p>Constructing a {{ snake_case_to_words($buildingType) }} here will cost you:</p>

                    <ul>
                        @foreach ($constructBuildingCalculator->getSupplyCosts($buildingType) as $supplyType => $requiredAmount)
                            <li>
                                {{ number_format($requiredAmount) }}x
                                {{--<img src="{{ asset("images/supplies/{$supplyType}.png") }}"
                                     alt="{{ snake_case_to_words($supplyType) }}"
                                     style="height: 1rem; width: auto;">--}}
                                {{ snake_case_to_words($supplyType) }}
                            </li>
                        @endforeach
                    </ul>

                    <p>Working at the {{ snake_case_to_words($buildingType) }} here will gain you:</p>

                    <ul>
                        @foreach ($workBuildingCalculator->getSupplyGains($buildingType) as $supplyType => $amount)
                            <li>
                                {{ number_format($amount) }}x
                                {{--<img src="{{ asset("images/supplies/{$supplyType}.png") }}"
                                     alt="{{ snake_case_to_words($supplyType) }}"
                                     style="height: 1rem; width: auto;">--}}
                                {{ snake_case_to_words($supplyType) }}
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('buildings.construct') }}" method="POST">
                        @csrf

                        <input type="hidden" name="building_type" value="{{ $buildingType }}">
                        <button type="submit" class="btn btn-primary" {{ (!$constructBuildingCalculator->canAffordConstruction($character, $buildingType) || ($character->energy < $constructBuildingCalculator->getEnergyCost($character, $buildingType))) ? 'disabled' : null }}>
                            Construct (-{{ $constructBuildingCalculator->getEnergyCost($character, $buildingType) }}e)
                        </button>
                    </form>
                </x-card>
            </div>
        @endforeach
    </div>
@endsection
