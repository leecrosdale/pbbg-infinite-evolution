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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <meta property="og:title" content="Infinite Evolution">
    <meta property="og:site_name" content="Infinite Evolution">
    <meta property="og:url" content="https://infinite-evolution.co.uk">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://infinite-evolution.co.uk/img/iflogo.png">

</head>
<body class="evolution--{{ $character->evolution->slug }}">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/icons/infinity.svg') }}" alt="Infinite" height="30" class="align-top">
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
                            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('locations') ? 'active' : null }}">
                            <a href="{{ route('locations') }}" class="nav-link">Locations</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('buildings') ? 'active' : null }}">
                            <a href="{{ route('buildings') }}" class="nav-link">Buildings</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('training') ? 'active' : null }}">
                            <a href="{{ route('training') }}" class="nav-link">Training</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('items') ? 'active' : null }}">
                            <a href="{{ route('items') }}" class="nav-link">Items</a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('leaderboard') ? 'active' : null }}">
                            <a href="{{ route('leaderboard') }}" class="nav-link">Leaderboard</a>
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

    <main class="py-4">
        @isset($character)
        <div class="container mb-4">
            <div class="card">
                <div class="card-body py-2 px-4">
                    <div class="row">
                        @foreach (\App\Enums\SupplyType::all() as $supplyType)
                            @php ($item = $character->getItem($supplyType))
                            @php ($qty = $character->getItem($supplyType)->pivot->qty ?? 0)

                            @if ($qty === 0)
                                @continue;
                            @endif

                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <span class="font-weight-bold">{{ $item->name }}:</span>
                                {{ number_format($qty) }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endisset

        @if ($errors->any())
            <div class="container">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        @if (session('levelUpStatus'))
            <div class="container">
                <div class="alert alert-info" role="alert">
                    {{ session('levelUpStatus') }}
                </div>
            </div>
        @endif

        @if (session('evolveStatus'))
            <div class="container">
                <div class="alert alert-info" role="alert">
                    {{ session('evolveStatus') }}
                </div>
            </div>
        @endif

        @if (session('status'))
            <div class="container">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @auth
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        @yield('content')
                    </div>

                    <div class="col-12 col-lg-4">
                        <x-stats/>
                    </div>
                </div>
            </div>
        @else
            @yield('content')
        @endauth

    </main>
</div>

@stack('scripts')
</body>
</html>
