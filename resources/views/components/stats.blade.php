<x-card header="Stats" class="mt-3 mt-lg-0">
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
            <div class="mt-2">
                <div class="font-weight-bold">Money:</div>
                <div>{{ number_format($character->money) }}</div>
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
                <div class="font-weight-bold">Strength:</div>
                <div>{{ number_format($character->stat_strength) }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Stamina:</div>
                <div>{{ number_format($character->stat_stamina) }}</div>
            </div>
        </div>
    </div>
</x-card>

<x-card header="Supplies" class="mt-3">
    <div class="row">
        <div class="col-6">
            <div class="mt-2">
                <div class="font-weight-bold">Food:</div>
                <div>{{ number_format($character->supply_food) }}</div>
            </div>
        </div>
        <div class="col-6">
            <div>
                <div class="font-weight-bold">Wood:</div>
                <div>{{ number_format($character->supply_wood) }}</div>
            </div>
            <div class="mt-2">
                <div class="font-weight-bold">Stone:</div>
                <div>{{ number_format($character->supply_stone) }}</div>
            </div>
        </div>
    </div>
</x-card>
