@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-8">
                <x-card header="Buildings at {{ $location->name }}">
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
                </x-card>
            </div>

            <div class="col-12 col-lg-4">
                <x-card header="Stats" class="mt-3 mt-lg-0">
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <div class="font-weight-bold">Name:</div>
                                <div>{{ $character->name }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Evolution:</div>
                                <div>{{ $character->evolution->name }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Level:</div>
                                <div>{{ number_format($character->level) }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Experience:</div>
                                <div>{{ number_format($character->experience) }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Money:</div>
                                <div>{{ number_format($character->money) }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <div class="font-weight-bold">Location:</div>
                                <div>{{ $location->name }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Health:</div>
                                <div>{{ number_format($character->health) }} / {{ number_format($character->max_health) }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Energy:</div>
                                <div>{{ number_format($character->energy) }} / {{ number_format($character->max_energy) }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Strength:</div>
                                <div>{{ number_format($character->stat_strength) }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Stamina:</div>
                                <div>{{ number_format($character->stat_stamina) }}</div>
                            </div>
                        </div>
                    </div>
                </x-card>

                <x-card header="Supply" class="mt-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="mt-2">
                                <div class="font-weight-bold">Food:</div>
                                <div>{{ number_format($character->supply_food) }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <div class="font-weight-bold">Wood:</div>
                                <div>{{ number_format($character->supply_wood) }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Stone:</div>
                                <div>{{ number_format($character->supply_stone) }}</div>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

        </div>
    </div>
@endsection
