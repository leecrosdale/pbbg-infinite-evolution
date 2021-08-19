@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-12">
                <x-card header="Travelling" class="mb-3">
                    @if (!$character->canBeFreed())
                        You are currently travelling to {{ $location->name }} and will arrive in {{ $character->free_time }}.
                    @else
                        <p>You have arrived at {{ $location->name }}.</p>
                        <p class="mb-0">
                            <a href="{{ route('dashboard') }}" class="btn btn-success">View Location</a>
                        </p>
                    @endif
                </x-card>
            </div>

        </div>
    </div>
@endsection
