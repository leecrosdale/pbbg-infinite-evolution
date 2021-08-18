@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach ($evolutions as $evolution)
            <h2>{{ $evolution->name }}</h2>

            @foreach ($evolution->locations as $location)
                <x-card header="Location: {{ $location->name }}" class="mb-3">

                    @if ($location->characters->count() === 0)
                        No characters detected.
                    @else
                        <x-slot name="bodyClass">p-0 table-responsive</x-slot>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Character</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($location->characters as $locationCharacter)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $locationCharacter->name }}
                                            @if ($locationCharacter->id === $character->id)
                                                <span class="badge badge-primary">You</span>
                                            @endif
                                        </td>
                                        <td class="text-right align-middle">
                                            @if ($locationCharacter->id !== $character->id)
                                                <a href="#" class="btn btn-sm btn-primary">Message</a>
                                                <a href="#" class="btn btn-sm btn-danger">Attack</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </x-card>
            @endforeach

        @endforeach

    </div>
@endsection
