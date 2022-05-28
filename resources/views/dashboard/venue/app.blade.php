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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
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
<!--    <ul class="nav nav-tabs">
        <li class="active">
            <a  href="#1" role="tab">Overview</a>
        </li>
        <li>
            <a href="#2" role="tab">Without clearfix</a>
        </li>
        <li>
            <a href="#3" role="tab">Solution</a>
        </li>
    </ul>

    <div class="tab-content ">
        <div class="tab-pane active" id="1">
            <h3>Standard tab panel created on bootstrap using nav-tabs</h3>
        </div>
        <div class="tab-pane" id="2">
            <h3>Notice the gap between the content and tab after applying a background color</h3>
        </div>
        <div class="tab-pane" id="3">
            <h3>add clearfix to tab-content (see the css)</h3>
        </div>
    </div>-->
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
