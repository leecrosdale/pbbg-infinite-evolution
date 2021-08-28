@extends('layouts.app')

@section('description')
    <p>The items page shows you all items in your inventory, your equipped items, plus items you can craft at your current location.</p>
@endsection

@section('content')
    <h1>Inventory</h1>

    @if ($items->count() === 0)
        <p class="my-4 text-xl">You currently do not have any items.</p>
    @else
        <x-card class="mb-4">
            <x-slot name="bodyClass">p-0 table-responsive</x-slot>

            <table class="table table-hover mb-0">
                <thead class="text-white bg-secondary">
                    <tr>
                        <td>Item</td>
                        <td>Quantity</td>
                        <td>Buffs</td>
                        <td width="130">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($item->type === 'base')
                                        <img src="{{ asset("img/icons/supplies/" . Str::slug($item->name) . ".svg") }}"
                                             alt="{{ snake_case_to_words($item->type) }}"
                                             class="mr-1"
                                             style="height: 1rem; filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.25));">
                                    @endif
                                    <span class="font-weight-bold">{{ $item->name }}</span>
                                    @if ($item->pivot->equipped)
                                        <span class="badge badge-success ml-2">Equipped</span>
                                    @endif
                                </div>
                                <small class="text-secondary">
                                    {{ snake_case_to_words($item->type) }}
                                    ({{ $item->evolution->name }})
                                </small>
                            </td>
                            <td>
                                {{ number_format($item->pivot->qty) }}
                            </td>
                            <td>
                                @if ($item->buffs)
                                    <div class="d-flex flex-wrap">
                                        @php($statSprites = ['attack' => 'ra ra-sword', 'defence' => 'fas fa-shield-alt'])
                                        @foreach ($item->buffs as $buffName => $buffValue)
                                            <div class="d-flex align-items-center mr-2 text-{{ $buffName === 'attack' ? 'danger' : 'info' }}">
                                                <i class="{{ $statSprites[$buffName] }}"></i>
                                                @if ($buffValue > 0)
                                                    +{{ number_format($buffValue) }}
                                                @elseif ($buffValue < 0)
                                                    {{ number_format($buffValue)  }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if ($item->equippable)
                                    @if ($item->pivot->equipped)
                                        <a href="{{ route('items.unequip', $item) }}" class="btn btn-block btn-danger">
                                            <div>Un-Equip</div>
                                            <small class="d-flex justify-content-center">
                                                <div><i class="fas fa-bolt"></i> -1</div>
                                            </small>
                                        </a>
                                    @else
                                        <a href="{{ route('items.equip', $item) }}" class="btn btn-block btn-success">
                                            <div>Equip</div>
                                            <small class="d-flex justify-content-center">
                                                <div><i class="fas fa-bolt"></i> -1</div>
                                            </small>
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    @endif

    <h2>Crafting</h2>

    @if ($craftableItems->count() === 0)
        <p class="my-4 text-xl">No craftable items available at this location.</p>
    @else
        <x-card class="mb-4">
            <x-slot name="bodyClass">p-0 table-responsive</x-slot>

            <table class="table table-hover mb-0">
                <thead class="text-white bg-secondary">
                    <tr>
                        <td>Item</td>
                        <td>Recipe</td>
                        <td>Buffs</td>
                        <td width="130">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($craftableItems as $item)
                        <tr>
                            <td>
                                <div>
                                    <span class="font-weight-bold">{{ $item->name }}</span>
                                </div>
                                <small class="text-secondary">
                                    {{ snake_case_to_words($item->type) }}
                                    ({{ $item->evolution->name }})
                                </small>
                            </td>
                            <td>
                                @if ($item->recipe)
                                    <div class="d-flex flex-wrap">
                                        @foreach ($item->recipe as $recipe)
                                            @if ($recipe->qty === 0)
                                                @continue
                                            @endif

                                            {{-- todo: we really need to use Eloquent relations for this :( N+1 issue atm --}}
                                            @php($itemRecipe = \App\Models\Item::find($recipe->item_id))

                                            <div class="d-flex align-items-center mr-2">
                                                <img src="{{ asset("img/icons/supplies/" . Str::slug($itemRecipe->name) . ".svg") }}"
                                                     alt="{{ snake_case_to_words($itemRecipe->type) }}"
                                                     class="mr-1"
                                                     style="height: 1rem; filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.25));">
                                                <span class="text-{{ $character->hasItemQty($itemRecipe, $recipe->qty) ? 'success' : 'danger' }}">
                                                {{ number_format($recipe->qty) }}
                                            </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if ($item->buffs)
                                    <div class="d-flex flex-wrap">
                                        @php($statSprites = ['attack' => 'ra ra-sword', 'defence' => 'fas fa-shield-alt'])
                                        @foreach ($item->buffs as $buffName => $buffValue)
                                            <div class="d-flex align-items-center mr-2 text-{{ $buffName === 'attack' ? 'danger' : 'info' }}">
                                                <i class="{{ $statSprites[$buffName] }}"></i>
                                                @if ($buffValue > 0)
                                                    +{{ number_format($buffValue) }}
                                                @elseif ($buffValue < 0)
                                                    {{ number_format($buffValue)  }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('items.craft', $item) }}" class="btn btn-block btn-primary">
                                    <div>Craft</div>
                                    <small class="d-flex justify-content-center">
                                        <div><i class="fas fa-bolt"></i> -1</div>
                                    </small>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    @endif
@endsection
