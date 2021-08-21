@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @foreach (\App\Enums\BuildingType::$buildingTypes as $buildingType)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                    <x-card header="{{ snake_case_to_words($buildingType) }}">

                        @php($building = $character->buildings->filter(fn ($building) => $building->type === $buildingType && $building->location_id === $character->location->id)->first())

                        @if ($building !== null)
                            <div class="row">
                                <div class="col-6">
                                    <p>Working here will gain you:</p>

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

                                    <form action="{{ route('buildings.work') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="building_type" value="{{ $buildingType }}">
                                        <button type="submit" class="btn btn-success">
                                            Work (-{{ number_format($workBuildingCalculator->getEnergyCost($character, $buildingType)) }} energy)
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <p>Your current {{ snake_case_to_words($buildingType) }} level is {{ number_format($building->level) }}.</p>

                                    <p>Upgrading will cost you:</p>

                                    <ul>
                                        <li>todo</li>
                                    </ul>

                                    <p>Upgrading improve your work action by:</p>

                                    <ul>
                                        <li>todo</li>
                                    </ul>

                                    <form action="{{ route('buildings.upgrade') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="building_type" value="{{ $buildingType }}">
                                        <button type="submit" class="btn btn-primary">
                                            Upgrade
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <p>You have no {{ snake_case_to_words($buildingType) }} here.</p>

                            <p>Construction costs:</p>

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

                            <p>Job work gains:</p>

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
                                <button type="submit" class="btn btn-primary">
                                    Construct
                                </button>
                            </form>
                        @endif

                    </x-card>
                </div>
            @endforeach
        </div>

{{--
        [image]
        Name
        Level

        Health + Health bar

        [Work Action] + work gains (supply)
        [Upgrade Action] + upgrade costs (+ work gain improvements)
--}}

        <x-card header="Buildings at {{ $location->name }}">

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
                                    <div>{{ number_format($building->health) }}
                                        / {{ number_format($building->max_health) }}</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: {{ ($building->health / $building->max_health) * 100 }}%;"></div>
                                    </div>
                                </td>
                                <td class="text-right align-middle">
                                    <a href="#" class="btn btn-success">Work</a>
                                    <a href="#" class="btn btn-primary">Upgrade</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </x-card>

    </div>
@endsection
