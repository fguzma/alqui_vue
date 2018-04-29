<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="/img/santana.png" type="image/x-icon" rel="shortcut icon" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-info" style="width:100%; height:100%;">
<div id="some" >
    <nav class="navbar bg-info navbar-static-top" style=" background-color:#0976A5;" >
        <div class="container" >
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <!--Agregar flecha de retroseso-->
                <a class="navbar-brand menu" style="color: white;" href="{{ url('/') }}">
                    Regresar
                </a>
            </div>

            <div class="collapse navbar-collapse " id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav ">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right ">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}" class="menu" style="color: white;">Ingresar</a></li>
                        <li><a href="{{ route('register') }}" class="menu" style="color: white;">Registrarse</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar seción
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
