@extends('layouts.app')

@section('description')
    <p class="mb-0">Your dashboard lists your buildings and other players in your current location.</p>
@endsection

@section('content')
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
