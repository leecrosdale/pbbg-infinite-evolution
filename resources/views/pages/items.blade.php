@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12 col-md-12">

            <x-card header="Your Items">

                @if ($items->count() === 0)
                    You have no items yet!
                @else
                    <x-slot name="bodyClass">p-0 table-responsive</x-slot>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Evolution</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Buffs</th>
                            <th>Equipped</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->evolution->name }}</td>
                                <td>{{ snake_case_to_words($item->name) }}</td>
                                <td>{{ snake_case_to_words($item->type) }}</td>
                                <td>{{ $item->pivot->qty }}</td>
                                <td>

                                    @if ($item->buffs)
                                        @foreach ($item->buffs as $k => $v)
                                                @if ($v > 0)
                                                    <span class="badge badge-primary">{{ snake_case_to_words($k) }} +{{ $v }}</span>
                                                @elseif ($v < 0)
                                                    <span class="badge badge-danger">{{ snake_case_to_words($k) }} {{ $v }}</span>
                                                @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if ($item->pivot->equipped)
                                        Equipped
                                    @endif
                                </td>
                                @if ($item->equippable)
                                    <td class="text-right align-middle">
                                        @if ($item->pivot->equipped)
                                            <a href="{{ route('items.unequip', $item) }}"
                                               class="btn btn-sm btn-primary">Un-Equip</a>
                                        @else
                                            <a href="{{ route('items.equip', $item) }}" class="btn btn-sm btn-primary">Equip</a>
                                        @endif
                                    </td>
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
