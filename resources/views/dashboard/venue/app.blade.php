<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Event Management') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/venue/home') }}">
                Venue
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('venue.profile', Auth::user()->venueOrganizerID) }}"
                               onclick="event.preventDefault();
                                                    document.getElementById('profile-form').submit();">
                                {{ __('Profile') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('venue.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('venue.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <form id="profile-form" action="{{ route('venue.profile', Auth::user()->venueOrganizerID) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
            <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{request()->is('venue.home') ? 'active' : null}}" href="{{ route('venue.home') }}" >Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->is('venue.create') ? 'active' : null}}" href="{{  route('venue.create') }}">Create Venue</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->is('venue.name.list') ? 'active' : null}}" href="{{ route('venue.name.list', Auth::user()->venueOrganizerID) }}">My Venues</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->is('venue.book.request') ? 'active' : null}}" href="{{ route('venue.book.request', Auth::user()->venueOrganizerID) }}">Booking Requests</a>
            </li>
        </ul>

    </div>
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
