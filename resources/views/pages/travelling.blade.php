@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-12">
                <x-card header="Travelling" class="mb-3">
                    <x-slot name="bodyClass">p-2 mb-3 table-responsive</x-slot>

                    @if (!$character->canBeFreed())

                    You are currently travelling and will arrive in {{ $character->free_time }}

                    @else

                    You have arrived

                    @endif
                </x-card>


            </div>

        </div>
    </div>
@endsection
