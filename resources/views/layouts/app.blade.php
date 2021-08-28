<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Infinite Evolution</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Open Graph tags -->
    <meta property="og:title" content="Infinite Evolution">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('img/logo-square.png') }}">
    <meta property="og:url" content="https://infinite-evolution.co.uk">
    <meta property="og:description" content="A free to play persistent text-based browser role playing game. Created for the PBBG Game Jam 2021.">

</head>
<body class="evolution--{{ $character->location->evolution->slug }}">
<div id="app">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('img/icons/infinity.svg') }}" alt="Infinite" height="30" class="align-top mr-1">
                Evolution
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : null }}">
                            <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('buildings') ? 'active' : null }}">
                            <a href="{{ route('buildings') }}" class="nav-link"><i class="fas fa-building"></i> Buildings</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('locations') ? 'active' : null }}">
                            <a href="{{ route('locations') }}" class="nav-link"><i class="fas fa-map-marked-alt"></i> Locations</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('training') ? 'active' : null }}">
                            <a href="{{ route('training') }}" class="nav-link"><i class="ra ra-muscle-up"></i> Training</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('items') ? 'active' : null }}">
                            <a href="{{ route('items') }}" class="nav-link"><i class="fas fa-th"></i> Items</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('leaderboard') ? 'active' : null }}">
                            <a href="{{ route('leaderboard') }}" class="nav-link"><i class="fas fa-trophy"></i> Leaderboard</a>
                        </li>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    {{ __('Settings') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <!-- Status Bar -->
        <div class="container mb-4">
            <div class="row">

                <!-- Evolution & Location -->
                <div class="col-12 col-md-6 d-flex mt-1 align-items-baseline justify-content-between justify-content-md-start">
                    <div class="font-header text-uppercase" style="font-size: 1.25rem;">
                        {{ $character->location->evolution->name }}
                    </div>
                    <div class="d-flex">
                        <div class="ml-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="font-header font-weight-normal ml-1">
                            {{ $character->location->name }}
                        </div>
                    </div>
                </div>

                <!-- Mobile: Level & Experience -->
                <div class="col-6 d-md-none">
                    Level <span class="font-weight-bold">{{ number_format($character->level) }}</span>
                    <span class="text-muted">({{ number_format($character->experience) }} xp)</span>
                </div>

                <!-- Attack & Defence -->
                <div class="col-6 d-flex justify-content-end text-md-xl">
                    <div class="text-danger font-header font-weight-bold" style="filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.25));">
                        <i class="ra ra-sword"></i> {{ number_format($character->stat_attack) }}
                    </div>
                    <div class="text-info font-header font-weight-bold ml-3" style="filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.25));">
                        <i class="fas fa-shield-alt"></i> {{ number_format($character->stat_defence) }}
                    </div>
                </div>

            </div>
            <div class="row mt-1">

                <!-- Desktop: Level & Experience -->
                <div class="d-none d-md-block col-6">
                    Level <span class="font-weight-bold">{{ number_format($character->level) }}</span>
                    <span class="text-muted">({{ number_format($character->experience) }} xp)</span>
                </div>

                <!-- Supplies -->
                <div class="col-12 col-md-6 d-flex justify-content-around justify-content-md-end">
                    @foreach (\App\Enums\SupplyType::all() as $supplyType)
                        @php ($item = $character->getItem($supplyType))
                        @php ($qty = $character->getItem($supplyType)->pivot->qty ?? 0)

                        @if ($qty === 0)
                            @continue;
                        @endif

                        <div class="mr-3 mr-md-0 ml-md-3 d-flex align-items-center">
                            <img src="{{ asset("img/icons/supplies/{$supplyType}.svg") }}"
                                 alt="{{ snake_case_to_words($supplyType) }}"
                                 style="height: 1rem; filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.25));">
                            <span class="ml-1">
                                {{ number_format($qty) }}
                            </span>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="row flex-column-reverse flex-md-row">

                <!-- Main Content -->
                <div class="col-12 col-md-9 mt-3 mt-md-4">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    @if (session('levelUpStatus'))
                        <div class="alert alert-info" role="alert">
                            {{ session('levelUpStatus') }}
                        </div>
                    @endif

                    @if (session('evolveStatus'))
                        <div class="alert alert-info" role="alert">
                            {{ session('evolveStatus') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @yield('content')

                </div>

                <!-- Health & Energy -->
                <div class="col-12 col-md-3 mt-md-4">
                    <div class="row mt-1">

                        <div class="col-6 col-md-12">
                            <div class="progress" style="background-color: #fceaea; filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.25));">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $character->health_percentage }}%;"></div>
                            </div>
                            <small class="d-flex justify-content-between flex-md-row-reverse">
                                <div class="font-weight-bold">
                                    {{ number_format($character->health) }} / {{ number_format($character->max_health) }}
                                </div>
                                <div class="font-header text-uppercase d-flex align-items-baseline flex-row-reverse flex-md-row">
                                    <i class="fas fa-heart ml-1 ml-md-0 mr-md-1"></i> Health
                                </div>
                            </small>
                        </div>

                        <div class="col-6 col-md-12 mt-md-3">
                            <div class="progress" style="background-color: #fff8e6; filter: drop-shadow(1px 1px 1px rgba(0, 0, 0, 0.25));">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $character->energy_percentage }}%;"></div>
                            </div>
                            <small class="d-flex justify-content-between flex-row-reverse">
                                <div class="font-weight-bold">
                                    {{ number_format($character->energy) }} / {{ number_format($character->max_energy) }}
                                </div>
                                <div class="font-header text-uppercase d-flex align-items-baseline">
                                    <i class="fas fa-bolt mr-1"></i> Energy
                                </div>
                            </small>
                        </div>

                    </div>

                    @hasSection('description')
                        <div class="d-none d-md-block mt-3 mt-md-4">
                            @yield('description')
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </main>
</div>

@stack('scripts')
</body>
</html>
