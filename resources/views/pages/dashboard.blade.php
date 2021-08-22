@extends('layouts.app')

@section('content')
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
