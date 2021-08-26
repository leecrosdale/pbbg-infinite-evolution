@extends('layouts.app')

@section('content')
    <x-card header="Leaderboard" class="mb-4">
        <x-slot name="bodyClass">p-0 table-responsive</x-slot>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Experience</th>
                    <th>Level</th>
                    <th>Evolution</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topCharacters as $topCharacter)
                    <tr>
                        <td>{{ $topCharacter->name }}</td>
                        <td>{{ number_format($topCharacter->experience) }}</td>
                        <td>{{ number_format($topCharacter->level) }}</td>
                        <td>{{ $topCharacter->evolution->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
@endsection
