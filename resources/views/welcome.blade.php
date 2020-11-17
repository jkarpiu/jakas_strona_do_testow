<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Egzaminki</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="css/app.css">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: rgb(25, 25, 25);
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
        }

        .full-height {
            height: 8vh;
        }

        .top-right {
            position: absolute;
            margin-top: 0.3rem;
            right: 10px;
            top: 18px;

        }

        .top-left>a {
            position: absolute;
            text-decoration: none;
            font-size: 1.5rem;
            margin-left: 1rem;
            margin-top: 1px;
            color: #fcfcfc;
            left: 10px;
            top: 18px;
        }

        .top-left>a:hover {
            opacity: 0.3;
        }

        .top-right>a:hover {
            opacity: 0.3;
        }

        .content {
            text-align: center;
            background-color: #fcfcfc;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            margin-top: 10vh;

        }

        .links>a {
            color: #fcfcfc;
            padding: 0 15px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        #footer {
            background-color: rgb(25, 25, 25);
            clear: both;
            color: #fcfcfc;
            display: block;
            height: 2vh;
            margin-bottom: 3vh;
            text-align: center;
            text-transform: uppercase;
        }

    </style>
</head>

<body>
    <div class="full-height">
        @if (Route::has('login'))
        <div id="nav">
            <div class="top-right links">
                <a href="">Losuj 40 pytań</a>
                <a href="">Losuj 1 pytanie</a>
                @guest
                    <a class="nav-link" href="{{ route('login') }}">Zaloguj się</a>
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">Zarejestruj się</a>
                @endif
                @else
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Wyloguj się
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest

            </div>
            <div class="top-left">
                <a href="">Egzaminki</a>
            </div>
        </div>

        @endif

        <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper nisi eu dictum aliquet.
                Aenean sit amet nunc vel odio luctus tristique id id mi. Mauris eu diam nulla. Ut finibus lectus vel
                felis viverra vestibulum. Suspendisse blandit felis lobortis dapibus suscipit. Mauris ante odio,
                pulvinar sit amet libero vel, pharetra porttitor dolor. Phasellus feugiat urna tortor, id eleifend
                neque tincidunt vel. Ut euismod ultricies sagittis. Duis nibh velit, pellentesque nec maximus ac,
                finibus finibus libero. Vivamus vel vulputate dolor, varius cursus neque. Aliquam euismod, erat non
                ultricies fringilla, ante est vestibulum dui, quis vehicula leo libero et felis. Integer commodo
                elementum efficitur. Integer lorem magna, vehicula vel finibus ut, porttitor sed nisi. Quisque
                varius est in nulla luctus, a elementum magna fermentum. Nunc mollis massa posuere, aliquam diam id,
                dignissim libero. Nullam eget nibh sit amet lacus condimentum viverra.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper nisi eu dictum aliquet.
                Aenean sit amet nunc vel odio luctus tristique id id mi. Mauris eu diam nulla. Ut finibus lectus vel
                felis viverra vestibulum. Suspendisse blandit felis lobortis dapibus suscipit. Mauris ante odio,
                pulvinar sit amet libero vel, pharetra porttitor dolor. Phasellus feugiat urna tortor, id eleifend
                neque tincidunt vel. Ut euismod ultricies sagittis. Duis nibh velit, pellentesque nec maximus ac,
                finibus finibus libero. Vivamus vel vulputate dolor, varius cursus neque. Aliquam euismod, erat non
                ultricies fringilla, ante est vestibulum dui, quis vehicula leo libero et felis. Integer commodo
                elementum efficitur. Integer lorem magna, vehicula vel finibus ut, porttitor sed nisi. Quisque
                varius est in nulla luctus, a elementum magna fermentum. Nunc mollis massa posuere, aliquam diam id,
                dignissim libero. Nullam eget nibh sit amet lacus condimentum viverra.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper nisi eu dictum aliquet.
                Aenean sit amet nunc vel odio luctus tristique id id mi. Mauris eu diam nulla. Ut finibus lectus vel
                felis viverra vestibulum. Suspendisse blandit felis lobortis dapibus suscipit. Mauris ante odio,
                pulvinar sit amet libero vel, pharetra porttitor dolor. Phasellus feugiat urna tortor, id eleifend
                neque tincidunt vel. Ut euismod ultricies sagittis. Duis nibh velit, pellentesque nec maximus ac,
                finibus finibus libero. Vivamus vel vulputate dolor, varius cursus neque. Aliquam euismod, erat non
                ultricies fringilla, ante est vestibulum dui, quis vehicula leo libero et felis. Integer commodo
                elementum efficitur. Integer lorem magna, vehicula vel finibus ut, porttitor sed nisi. Quisque
                varius est in nulla luctus, a elementum magna fermentum. Nunc mollis massa posuere, aliquam diam id,
                dignissim libero. Nullam eget nibh sit amet lacus condimentum viverra.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper nisi eu dictum aliquet.
                Aenean sit amet nunc vel odio luctus tristique id id mi. Mauris eu diam nulla. Ut finibus lectus vel
                felis viverra vestibulum. Suspendisse blandit felis lobortis dapibus suscipit. Mauris ante odio,
                pulvinar sit amet libero vel, pharetra porttitor dolor. Phasellus feugiat urna tortor, id eleifend
                neque tincidunt vel. Ut euismod ultricies sagittis. Duis nibh velit, pellentesque nec maximus ac,
                finibus finibus libero. Vivamus vel vulputate dolor, varius cursus neque. Aliquam euismod, erat non
                ultricies fringilla, ante est vestibulum dui, quis vehicula leo libero et felis. Integer commodo
                elementum efficitur. Integer lorem magna, vehicula vel finibus ut, porttitor sed nisi. Quisque
                varius est in nulla luctus, a elementum magna fermentum. Nunc mollis massa posuere, aliquam diam id,
                dignissim libero. Nullam eget nibh sit amet lacus condimentum viverra.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ullamcorper nisi eu dictum aliquet.
                Aenean sit amet nunc vel odio luctus tristique id id mi. Mauris eu diam nulla. Ut finibus lectus vel
                felis viverra vestibulum. Suspendisse blandit felis lobortis dapibus suscipit. Mauris ante odio,
                pulvinar sit amet libero vel, pharetra porttitor dolor. Phasellus feugiat urna tortor, id eleifend
                neque tincidunt vel. Ut euismod ultricies sagittis. Duis nibh velit, pellentesque nec maximus ac,
                finibus finibus libero. Vivamus vel vulputate dolor, varius cursus neque. Aliquam euismod, erat non
                ultricies fringilla, ante est vestibulum dui, quis vehicula leo libero et felis. Integer commodo
                elementum efficitur. Integer lorem magna, vehicula vel finibus ut, porttitor sed nisi. Quisque
                varius est in nulla luctus, a elementum magna fermentum. Nunc mollis massa posuere, aliquam diam id,
                dignissim libero. Nullam eget nibh sit amet lacus condimentum viverra.</p>
        </div>
        <div id="footer">
            <p>Stroneczka egzaminki no copyrights</p>
        </div>
    </div>
    <script src="js/app.jss"></script>
</body>

</html>
