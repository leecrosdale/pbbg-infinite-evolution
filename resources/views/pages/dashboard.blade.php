@extends('layouts.app')

@section('description')
    <p class="mb-0">Your dashboard lists your buildings and other players in your current location.</p>
@endsection

@section('content')
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-12 col-lg-6">

            <div class="card">
                <div class="card-header px-3 text-white bg-secondary">
                    <div class="d-flex">
                        <div class="position-relative rounded-circle bg-white" style="width: 2.5rem; height: 2.5rem;">
                            <img src="{{ asset('img/icons/buildings/farm.svg') }}"
                                 alt=""
                                 class="d-block position-absolute"
                                 style="height: 2rem; margin: 0.25rem;">
                        </div>
                        <div class="ml-2 d-flex flex-grow-1 flex-column">
                            <div class="font-weight-bold">Farm</div>
                            <div class="d-flex justify-content-between">
                                <small>Level 1</small>
                                <small>100%</small>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-1" style="background-color: #fceaea; height: 4px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 90%;"></div>
                    </div>
                </div>
                <div class="card-body p-3">

                    <div class="font-weight-bold border-bottom">Work</div>
                    <div class="row mt-2">
                        <div class="col-6 d-flex flex-wrap align-items-start">
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/food.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-success">+5</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/stone.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-success">+5</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/wood.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-success">+5</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-block btn-success">
                                <div>Work</div>
                                <small class="d-flex justify-content-center">
                                    <div><i class="fas fa-bolt"></i> -3</div>
                                    <div class="ml-3"><i class="fas fa-hourglass"></i> 10</div>
                                </small>
                            </button>
                        </div>
                    </div>

                    <div class="font-weight-bold border-bottom">Upgrade</div>
                    <div class="row mt-2">
                        <div class="col-6 d-flex flex-wrap align-items-start">
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/food.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-danger">-50</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/stone.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-danger">-50</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/wood.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-danger">-50</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-block btn-secondary">
                                <div>Upgrade</div>
                                <small class="d-flex justify-content-center">
                                    <div><i class="fas fa-bolt"></i> -3</div>
                                </small>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-12 col-lg-6">

            <div class="card mt-3 mt-lg-0">
                <div class="card-header px-3 text-white bg-secondary">
                    <div class="d-flex">
                        <div class="position-relative rounded-circle bg-white" style="width: 2.5rem; height: 2.5rem;">
                            <img src="{{ asset('img/icons/buildings/mine.svg') }}"
                                 alt=""
                                 class="d-block position-absolute"
                                 style="height: 2rem; margin: 0.25rem;">
                        </div>
                        <div class="ml-2 d-flex flex-grow-1 flex-column">
                            <div class="font-weight-bold">Mine</div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">

                    <div class="font-weight-bold border-bottom">Construct</div>
                    <div class="row mt-2">
                        <div class="col-6 d-flex flex-wrap align-items-start">
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/food.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-danger">-50</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/stone.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-danger">-50</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/wood.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-danger">-50</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-block btn-primary">
                                <div>Construct</div>
                                <small class="d-flex justify-content-center">
                                    <div><i class="fas fa-bolt"></i> -3</div>
                                </small>
                            </button>
                        </div>
                    </div>

                    <div class="font-weight-bold border-bottom">Work</div>
                    <div class="row mt-2">
                        <div class="col-6 d-flex flex-wrap align-items-start">
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/food.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-success">+5</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/stone.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-success">+5</span>
                            </div>
                            <div class="d-flex align-items-center mr-2">
                                <img src="{{ asset('img/icons/supplies/wood.svg') }}"
                                     alt="Food"
                                     style="height: 1rem;">
                                <span class="ml-1 text-success">+5</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <h3>Buildings</h3>

    @if ($buildings->count() === 0)
        <p>You don't have any buildings constructed here at {{ $location->name }}.</p>
        <p>Head to the <a href="{{ route('buildings') }}">buildings page</a> to construct some.</p>
    @else
        <div class="row">
            @foreach ($buildings as $building)
                <div class="col-12 col-md-6 col-xl-4 mb-4">
                    <x-card>
                        <x-slot name="header">
                            {{ snake_case_to_words($building->type) }}
                            <span class="float-right text-muted">Lv.{{ number_format($building->level) }}</span>
                        </x-slot>

                        <x-slot name="bodyClass">p-2</x-slot>

                        <div class="mb-2">
                            <div class="font-weight-bold">Health:</div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ floor(($building->health / $building->max_health) * 100) }}%;"></div>
                            </div>
                            <span class="d-block text-right">
                                {{ number_format($building->health) }} / {{ number_format($building->max_health) }}
                            </span>
                        </div>

                        <progress-timer-component start-time="{{ $building->work_started_at }}" current-time="{{ now() }}" end-time="{{ $building->next_work_at }}">
                            <div class="row">
                                <div class="col-6">
                                    @php ($energyCostToWork = $workBuildingCalculator->getEnergyCost($character, $building->type))
                                    <form action="{{ route('buildings.work') }}" method="POST" class="d-inline-block">
                                        @csrf

                                        <input type="hidden" name="building_type" value="{{ $building->type }}">
                                        <button type="submit" class="btn btn-sm btn-success" {{ $character->energy < $energyCostToWork ? 'disabled' : null }}>
                                            Work (-{{ number_format($energyCostToWork) }}e)
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('buildings.upgrade') }}" method="POST" class="d-inline-block">
                                        @csrf

                                        <input type="hidden" name="building_type" value="{{ $building->type }}">
                                        <button type="submit" class="btn btn-sm btn-warning" {{ !$upgradeBuildingCalculator->canAffordUpgrade($character, $building) ? 'disabled' : null }}>
                                            Upgrade (-{{ $upgradeBuildingCalculator->getEnergyCost($character, $building->type) }}e)
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </progress-timer-component>
                    </x-card>
                </div>
            @endforeach
        </div>
    @endif

    <h3 class="mt-4">Other Players</h3>
    buildings here

    other players


    dashboard todo
    {{--<x-card header="Buildings at {{ $location->name }}">
        @php($buildings = $character->buildings()->where('location_id', $location->id)->get())

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
                                <div>{{ number_format($building->health) }} / {{ number_format($building->max_health) }}</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ ($building->health / $building->max_health) * 100 }}%;"></div>
                                </div>
                            </td>
                            <td class="text-right align-middle">
                                <a href="#" class="btn btn-success">Work</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </x-card>--}}
@endsection
