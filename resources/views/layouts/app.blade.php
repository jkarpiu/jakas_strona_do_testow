<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/default.css') }}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/default.css') }}" rel="stylesheet">
</head>

<body>
    <nav id="nav">

        <div class="top-left">
            <a href="">ipies</a>
        </div>
        <div class="top-right links">
            <ul>
                <span class="dropdown-display">     
                    @if (Auth::user())
                        @if (Auth::user()->role == 1)
                            <li> <a class="dropdown-item" href="">Panel ucznia</a> </li>
                        @else
                            <li> <a class="dropdown-item" href="">Panel nauczyciela</a> </li>
                        @endif
                    @endif
                    <li><a class="dropdown-item" href="">Losuj 40 pytań</a></li>
                    <li><a class="dropdown-item" href="{{ route('losowanie1') }}">Losuj 1 pytanie</a></li>
                    @guest
                        <li><a class="dropdown-item" href="{{ route('login') }}">Zaloguj się</a></li>
                        @if (Route::has('register'))
                            <li><a class="dropdown-item" href="{{ route('register') }}">Zarejestruj się</a></li>
                        @endif
                    @else

                        <li><a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->fname }}
                            </a>

                            <ul><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                    Wyloguj się
                                    <ul>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>
                    </span>
                </ul>
            </div>


        @endguest


    </nav>

    <div class="py-4 my-content">
        @yield('content')
    </div>
    <div id="footer">
        <p>Stroneczka egzaminki no copyrights</p>
    </div>

    </div>
</body>

</html>
