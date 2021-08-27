@extends('layouts.app')

@section('content')


    <x-card header="Leaderboard" class="mb-4">
        <x-slot name="bodyClass">p-0 table-responsive</x-slot>

        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Player</th>
                    <th class="text-right">Experience</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topCharacters as $topCharacter)
                    <tr>
                        <td>
                            <div>
                                <span class="font-weight-bold">{{ $topCharacter->name }}</span>
                                @if ($loop->index < 3)
                                    @php ($trophyColors = [0 => 'C9B037', 1 => 'B4B4B4', 2 => 'AD8A56'])
                                    <i class="fas fa-trophy" style="color: #{{ $trophyColors[$loop->index] }};"></i>
                                @endif
                            </div>
                            <small class="text-muted">Level {{ number_format($topCharacter->level) }}</small>
                        </td>
                        <td class="text-right">{{ number_format($topCharacter->experience) }}</td>
                        <td>
                            <div>
                                {{ $topCharacter->location->name }}
                            </div>
                            <small class="text-muted">{{ $topCharacter->location->evolution->name }}</small>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
@endsection
