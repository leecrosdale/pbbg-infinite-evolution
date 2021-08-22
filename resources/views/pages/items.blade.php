@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12 col-md-12">

            <x-card header="Craft Items">

                @if ($items->count() === 0)
                    You have no items yet!
                @else
                    <x-slot name="bodyClass">p-0 table-responsive</x-slot>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Equipped?</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->pivot->qty }}</td>
                                <td>{{ $item->pivot->equipped ? 'Yes' : 'No' }}</td>
                                @if ($item->equippable)
                                    <td>Equip</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </x-card>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12">
            <x-card header="Craft Items" class="mt-3">

                @if ($craftableItems->count() === 0)
                    No craftable items available
                @else
                    <x-slot name="bodyClass">p-1 table-responsive</x-slot>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($craftableItems as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </x-card>
        </div>
    </div>

@endsection
