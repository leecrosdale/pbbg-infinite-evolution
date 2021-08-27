@extends('layouts.app')

@section('description')
    <p>The leaderboard page shows the top 10 players the current round.</p>
    <p class="mb-0">You are rank <span class="font-weight-bold">{{ number_format($characterRank) }}</span> out of a total of <span class="font-weight-bold">{{ number_format($totalPlayers) }}</span> players.</p>
@endsection

@section('content')
    <x-card header="Leaderboard" class="mb-4">
        <x-slot name="bodyClass">p-0 table-responsive</x-slot>

        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Player</th>
                    <th class="text-right">Experience <i class="fas fa-caret-down"></i></th>
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
                                @if ($topCharacter->id === $character->id)
                                    <span class="badge badge-success">You</span>
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
