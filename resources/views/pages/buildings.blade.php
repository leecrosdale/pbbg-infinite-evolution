@extends('layouts.app')

@section('description')
    <p>The buildings page lists all your constructed buildings, as well as other buildings you construct in your current location.</p>
    <p class="mb-0">Different buildings can be constructed in different locations.</p>
@endsection

@section('content')
    <h1>Buildings</h1>

    @if ($buildings->count() === 0)
        <p class="my-4 text-xl">You don't have any buildings constructed here at {{ $location->name }}.</p>
    @else
        todo buildings here
    @endif

    <h2>Construct</h2>

    <div class="row">
        @foreach (\App\Enums\BuildingType::all() as $buildingType)
            @if ($buildingType === \App\Enums\BuildingType::SCAVENGERS_HUT)
                @continue
            @endif

            @php($building = $character->getBuilding($buildingType))

            @if ($building !== null)
                @continue
            @endif

            <div class="col-12 col-lg-6 mb-3">
                <div class="card mt-3 mt-lg-0">
                    <div class="card-header px-3 text-white bg-secondary">
                        <div class="d-flex">
                            <div class="position-relative rounded-circle bg-white" style="width: 2.5rem; height: 2.5rem;">
                                <img src="{{ asset("img/icons/buildings/{$buildingType}.svg") }}"
                                     alt=""
                                     class="d-block position-absolute"
                                     style="height: 2rem; margin: 0.25rem;">
                            </div>
                            <div class="ml-2 d-flex flex-grow-1 flex-column">
                                <div class="font-weight-bold">{{ snake_case_to_words($buildingType) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <div class="font-weight-bold border-bottom">Construct</div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex flex-wrap align-items-start">
                                @foreach ($constructBuildingCalculator->getSupplyCosts($buildingType) as $supplyType => $requiredAmount)
                                    <div class="d-flex align-items-center mr-2">
                                        <img src="{{ asset("img/icons/supplies/{$supplyType}.svg") }}"
                                             alt="{{ snake_case_to_words($supplyType) }}"
                                             style="height: 1rem;">
                                        <span class="ml-1 text-danger">-{{ number_format($requiredAmount) }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-6">
                                <form action="{{ route('buildings.construct') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="building_type" value="{{ $buildingType }}">
                                    <button type="submit" class="btn btn-block btn-primary" {{ (!$constructBuildingCalculator->canAffordConstruction($character, $buildingType) || ($character->energy < $constructBuildingCalculator->getEnergyCost($character, $buildingType))) ? 'disabled' : null }}>
                                        <div>Construct</div>
                                        <small class="d-flex justify-content-center">
                                            <div><i class="fas fa-bolt"></i> -{{ $constructBuildingCalculator->getEnergyCost($character, $buildingType) }}</div>
                                        </small>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="font-weight-bold border-bottom">Work</div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex flex-wrap align-items-start">
                                @foreach ($workBuildingCalculator->getSupplyGains($buildingType) as $supplyType => $amount)
                                    <div class="d-flex align-items-center mr-2">
                                        <img src="{{ asset("img/icons/supplies/{$supplyType}.svg") }}"
                                             alt="{{ snake_case_to_words($supplyType) }}"
                                             style="height: 1rem;">
                                        <span class="ml-1 text-success">+{{ number_format($amount) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <br><br><br>

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

                                    @if ($building->type !== \App\Enums\BuildingType::SCAVENGERS_HUT)
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
                                    @endif
                                </progress-timer-component>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </x-card>
@endsection
