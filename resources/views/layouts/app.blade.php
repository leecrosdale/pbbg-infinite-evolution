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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Infinite Evolution
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
                        <li class="navbar-text ml-2 d-flex align-items-center">
                            Health
                            <div class="progress ml-1" style="width: 50px;">
                                <div class="progress-bar bg-danger" role="progressbar"
                                     style="width: {{ $character->health_percentage }}%;"></div>
                            </div>
                        </li>

                        <li class="navbar-text ml-2 d-flex align-items-center">
                            Energy
                            <div class="progress ml-1" style="width: 50px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                     style="width: {{ $character->energy_percentage }}%;"></div>
                            </div>
                        </li>

                        <li class="nav-item ml-2 dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        @if ($errors->any())
            <div class="container">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
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
