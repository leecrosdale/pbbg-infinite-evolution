@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Dashboard - Location: {{ $character->location->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Buildings - <a href="#">Buy</a></h2>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Building</th>
                                <th>Level</th>
                                <th>Health</th>
                                <th>Next Work</th>
                                <th>Supply</th>
                                <th>Upgrade</th>
                                <th>Supply Requirements</th>
                                <th>Supply Remaining</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h2>Stats</h2>
                            <div>
                                Location: {{ $character->location->name }}<br>
                                Evolution: {{ $character->evolution->name }}<br>
                                Age: {{ $character->created_at->diffForHumans() }}<br>
                                Health: {{ number_format($character->health) }} / {{ number_format($character->max_health) }}<br>
                                Energy: {{ number_format($character->energy) }} / {{ number_format($character->max_energy) }}<br>
                                Level: {{ number_format($character->level) }}<br>
                                Experience: {{ number_format($character->experience) }}<br>
                                Strength: {{ number_format($character->strength) }}<br>
                                Stamina: {{ number_format($character->stamina) }}<br>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <h2>Supply</h2>
                            <div>
                                Gold: NYI<br>
                                Wood: NYI<br>
                                Stone: NYI<br>
                                Food: NYI<br>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
