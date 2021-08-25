<x-card header="Stats" class="mb-3">
    <div class="row">
        <div class="col-6">
            <div>
                <div class="font-weight-bold">Name:</div>
                <div>{{ $character->name }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Evolution:</div>
                <div>{{ $character->evolution->name }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Level:</div>
                <div>{{ number_format($character->level) }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Experience:</div>
                <div>{{ number_format($character->experience) }}</div>
            </div>
        </div>
        <div class="col-6">
            <div>
                <div class="font-weight-bold">Location:</div>
                <div>{{ $location->name }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Health:</div>
                <div>{{ number_format($character->health) }} / {{ number_format($character->max_health) }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Energy:</div>
                <div>{{ number_format($character->energy) }} / {{ number_format($character->max_energy) }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Attack:</div>
                <div>
                    {{ number_format($character->stat_attack) }}

                    @php ($attackBuff = $character->getEquippedItemBuffsByStatType(\App\Enums\CharacterStatType::ATTACK))

                    @if ($attackBuff > 0)
                        <span class="badge badge-success">+{{ number_format($attackBuff) }}</span>
                    @elseif ($attackBuff < 0)
                        <span class="badge badge-danger">{{ number_format($attackBuff) }}</span>
                    @endif

                </div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Defence:</div>
                <div>

                    {{ number_format($character->stat_defence) }}

                    @php ($defenceBuff = $character->getEquippedItemBuffsByStatType(\App\Enums\CharacterStatType::DEFENCE))

                    @if ($defenceBuff > 0)
                        <span class="badge badge-success">+{{ number_format($defenceBuff) }}</span>
                    @elseif ($defenceBuff < 0)
                        <span class="badge badge-danger">{{ number_format($defenceBuff) }}</span>
                    @endif



                </div>

            </div>
        </div>
    </div>
</x-card>

<x-card header="Supplies">
    <div class="row">
        @foreach (\App\Enums\SupplyType::all() as $supplyType)
            @php($item = $character->getItem($supplyType))
            <div class="col-6">
                <div class="mt-2">
                    <div class="font-weight-bold">{{ snake_case_to_words($supplyType) }}:</div>
                    <div>{{ number_format($character->getItem($supplyType)->pivot->qty ?? 0) }}</div>
                </div>
            </div>
        @endforeach
    </div>
</x-card>
