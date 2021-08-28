@extends('layouts.empty')

@section('content')

    <section id="hero" class="jumbotron jumbotron-fluid">
        <div class="container my-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 font-header" style="filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.5))">Infinite Evolution</h1>
                    <p class="lead">A free to play persistent text-based browser role playing game.</p>
                    <p class="lead">Created for the <a href="https://itch.io/jam/pbbg-game-jam-2021" target="_blank">PBBG Game Jam 2021</a> by <a href="https://www.wavehack.net/" target="_blank">WaveHack</a> (aka Sharqy) and <a href="https://crosdale.dev" target="_blank">Crosdale</a>.</p>
                    <p class="lead">Built with <a href="https://laravel.com/" target="_blank">Laravel</a>. Source code is on <a href="https://github.com/leecrosdale/pbbg-infinite-evolution" target="_blank">GitHub</a>.</p>
                    <p>
                        <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Register a Free Account</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="features">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>Features</h2>

                    <div class="row">
                        <div class="col-sm-4 mt-4 d-flex flex-column">
                            <img src="{{ asset('img/icons/path-distance.svg') }}" alt="Upgrade" style="height: 3rem;">
                            <p class="mt-2">Travel to different locations throughout the ages.</p>
                        </div>
                        <div class="col-sm-4 mt-4 d-flex flex-column">
                            <img src="{{ asset('img/icons/crane.svg') }}" alt="Upgrade" style="height: 3rem;">
                            <p class="mt-2">Construct buildings and work at them to increase your item supply.</p>
                        </div>
                        <div class="col-sm-4 mt-4 d-flex flex-column">
                            <img src="{{ asset('img/icons/swords-power.svg') }}" alt="Upgrade" style="height: 3rem;">
                            <p class="mt-2">Craft and equip Weapons, Armor and Tools to help you combat other players.</p>
                        </div>
                        <div class="col-sm-4 mt-4 d-flex flex-column">
                            <img src="{{ asset('img/icons/progression.svg') }}" alt="Upgrade" style="height: 3rem;">
                            <p class="mt-2">Advance through the ages to unlock new locations and buildings.</p>
                        </div>
                        <div class="col-sm-4 mt-4 d-flex flex-column">
                            <img src="{{ asset('img/icons/chest.svg') }}" alt="Upgrade" style="height: 3rem;">
                            <p class="mt-2">Find rare collectibles in certain locations.</p>
                        </div>
                        <div class="col-sm-4 mt-4 d-flex flex-column">
                            <img src="{{ asset('img/icons/falling-bomb.svg') }}" alt="Upgrade" style="height: 3rem;">
                            <p class="mt-2">Be the first to reach the Nano Age to craft a bomb to partially reset the server!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
