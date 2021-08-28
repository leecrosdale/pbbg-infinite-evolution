@extends('layouts.app')

@section('description')
    <p>The buildings page lists all your constructed buildings, as well as other buildings you construct in your current location.</p>
    <p class="mb-0">Different types of buildings can be constructed in different locations.</p>
@endsection

@section('content')
    <h1>Buildings</h1>

    @if ($buildings->count() === 0)
        <p class="my-4 text-xl">You don't have any buildings constructed here at {{ $location->name }}.</p>
    @else
        <div class="row">

            @foreach ($buildings as $building)
                <div class="col-12 col-lg-6 mb-4">
                    <div class="card mt-3 mt-lg-0">
                        <div class="card-header px-3 text-white bg-secondary">
                            <div class="d-flex">
                                <div class="position-relative rounded-circle bg-white" style="width: 2.5rem; height: 2.5rem;">
                                    <img src="{{ asset("img/icons/buildings/{$building->type}.svg") }}"
                                         alt="{{ snake_case_to_words($building->type) }}"
                                         class="d-block position-absolute"
                                         style="height: 2rem; margin: 0.25rem;">
                                </div>
                                <div class="ml-2 d-flex flex-grow-1 flex-column">
                                    <div class="font-weight-bold">{{ snake_case_to_words($building->type) }}</div>
                                    <div class="d-flex justify-content-between">
                                        <small>Level {{ number_format($building->level) }}</small>
                                        <small>{{ $building->getHealthPercentage() }}%</small>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-1" style="background-color: #fceaea; height: 4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $building->getHealthPercentage() }}%;"></div>
                            </div>
                        </div>
                        <div class="card-body p-3">

                            <div class="font-weight-bold border-bottom">Work</div>
                            <div class="row mt-2">
                                <div class="col-6 d-flex flex-wrap align-items-start">

                                    @foreach ($workBuildingCalculator->getSupplyGains($building->type, $building->level, $building->getHealthPercentage()) as $supplyType => $amount)
                                        <div class="d-flex align-items-center mr-2">
                                            <img src="{{ asset("img/icons/supplies/{$supplyType}.svg") }}"
                                                 alt="{{ snake_case_to_words($supplyType) }}"
                                                 style="height: 1rem;">
                                            <span class="ml-1 text-success">+{{ number_format($amount) }}</span>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="col-6">
                                    @php ($energyCostToWork = $workBuildingCalculator->getEnergyCost($character, $building->type))
                                    <form action="{{ route('buildings.work') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="building_type" value="{{ $building->type }}">
                                        <button type="submit" class="btn btn-block btn-success" {{ $character->energy < $energyCostToWork ? 'disabled' : null }}>
                                            <div>Work</div>
                                            <small class="d-flex justify-content-center">
                                                <div><i class="fas fa-bolt"></i> -{{ number_format($energyCostToWork) }}</div>
                                                <div class="ml-3"><i class="fas fa-hourglass"></i> {{ number_format($workBuildingCalculator->getCooldownInSeconds($character, $building)) }}</div>
                                            </small>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if ($building->type !== 'scavengers_hut')
                                <div class="font-weight-bold border-bottom">Upgrade</div>
                                <div class="row mt-2">
                                    <div class="col-6 d-flex flex-wrap align-items-start">

                                        @foreach ($upgradeBuildingCalculator->getSupplyCosts($building->type, $building) as $supplyType => $amount)
                                            <div class="d-flex align-items-center mr-2">
                                                <img src="{{ asset("img/icons/supplies/{$supplyType}.svg") }}"
                                                     alt="{{ snake_case_to_words($supplyType) }}"
                                                     style="height: 1rem;">
                                                <span class="ml-1 text-danger">-{{ number_format($amount) }}</span>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="col-6">
                                        @php ($energyCostToUpgrade = $workBuildingCalculator->getEnergyCost($character, $building->type))
                                        <form action="{{ route('buildings.upgrade') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="building_type" value="{{ $building->type }}">
                                            <button type="submit" class="btn btn-block btn-secondary" {{ $character->energy < $energyCostToUpgrade ? 'disabled' : null }}>
                                                <div>Upgrade</div>
                                                <small class="d-flex justify-content-center">
                                                    <div><i class="fas fa-bolt"></i> -{{ number_format($energyCostToUpgrade) }}</div>
                                                </small>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif

    @if (!empty($buildingTypesAvailableForConstruction))
        <h2 class="mt-3">Construct</h2>

        <div class="row">
            @foreach ($buildingTypesAvailableForConstruction as $buildingType)
                <div class="col-12 col-lg-6 mb-4">
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
    @endif
@endsection
