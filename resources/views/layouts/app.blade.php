<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Phproject') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/' . env('THEME', 'app') . '.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg {{ env('THEME', 'app') == 'app-dark' ? 'navbar-dark bg-dark' : 'navbar-light bg-light' }}">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Phproject') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @if (!Auth::guest())
                        <li class="nav-item dropdown">
                            <a href="{{ route('new_issue') }}" class="nav-link dropdown-toggle" id="navbarDropdownNew" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">New</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownNew">
                                @foreach ($issueTypes as $type)
                                    <a href="{{ route('new_issue', ['type' => $type->id]) }}" class="dropdown-item">
                                        {{ $type->name }}
                                    </a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ route('issues') }}" class="nav-link dropdown-toggle" id="navbarDropdownBrowse" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Browse</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownBrowse">
                                <a href="{{ route('issues') }}?status=open" class="dropdown-item">Open</a>
                                <a href="{{ route('issues') }}?status=closed" class="dropdown-item">Closed</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('issues') }}?author_id={{ Auth::id() }}" class="dropdown-item">Created by me</a>
                                <a href="{{ route('issues') }}?owner_id={{ Auth::id() }}" class="dropdown-item">Assigned to me</a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">By type</h6>
                                @foreach ($issueTypes as $type)
                                    <a href="{{ route('issues') }}?type_id={{ $type->id }}" class="dropdown-item">
                                        {{ $type->name }}
                                    </a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
