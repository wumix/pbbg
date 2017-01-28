<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="loader">
    <div><i class="fa fa-spinner fa-spin fa-3x"></i></div>
</div>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#left-nav">
                    <span class="sr-only">Toggle Left Navigation</span>
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-nav">
                    <span class="sr-only">Toggle User Info</span>
                    <i class="fa fa-user"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="top-nav">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ $char->displayname }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-2">
                <div class="collapse navbar-collapse" id="left-nav">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Main</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="#">Diamond Store</a></li>
                                <li><a href="#">Life Insurance</a></li>
                                <li><a href="#">Hospital</a></li>
                                <li><a href="#">Detective</a></li>
                                <li><a href="#">Respect</a></li>
                                <li><a href="#">Bounty</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">City</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="#">Airport</a></li>
                                <li><a href="#">Bank</a></li>
                                <li><a href="#">Bullet Factory</a></li>
                                <li><a href="#">Garage</a></li>
                                <li><a href="#">Auction House</a></li>
                                <li><a href="#">Graveyard</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Communication</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="#">Conversations</a></li>
                                <li><a href="#">Forums</a></li>
                                <li><a href="#">Helpdesk</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Criminal Activity</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="#">Crimes</a></li>
                                <li><a href="#">GTA</a></li>
                                <li><a href="#">Extortion</a></li>
                                <li><a href="#">Organised Crime</a></li>
                                <li><a href="#">Getaway</a></li>
                                <li><a href="#">Prison</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Casino</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="#">Blackjack</a></li>
                                <li><a href="#">Roulette</a></li>
                                <li><a href="#">Keno</a></li>
                                <li><a href="#">Race Track</a></li>
                                <li><a href="#">War</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $char->displayname }}</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><a href="#">Achievements</a></li>
                                <li><a href="#">Game statistics</a></li>
                                <li><a href="#">Your account</a></li>
                                <li><a href="#">Referrals</a></li>
                                <li><a href="#">Players Online</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-10">
                <div id="pjax-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="{{ elixir('js/vendor.js') }}"></script>
<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
