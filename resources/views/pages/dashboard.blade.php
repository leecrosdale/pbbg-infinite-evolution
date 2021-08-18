@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-8">
                <x-card header="Buildings at {{ $location->name }}">
                    <x-slot name="bodyClass">p-0 table-responsive</x-slot>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Building</th>
                                <th>Health</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">
                                    <div>Farm</div>
                                    <small class="text-secondary">Level 2</small>
                                </td>
                                <td class="align-middle">
                                    <div>80 / 100</div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 80%;"></div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="#" class="btn btn-success">Work</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                                <div>{{ number_format($character->strength) }}</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Stamina:</div>
                                <div>{{ number_format($character->stamina) }}</div>
                            </div>
                        </div>
                    </div>
                </x-card>

                <x-card header="Supply" class="mt-3">
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <div class="font-weight-bold">Gold:</div>
                                <div>NYI</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Food:</div>
                                <div>NYI</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <div class="font-weight-bold">Wood:</div>
                                <div>NYI</div>
                            </div>
                            <div class="mt-2">
                                <div class="font-weight-bold">Stone:</div>
                                <div>NYI</div>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

        </div>
    </div>
@endsection
