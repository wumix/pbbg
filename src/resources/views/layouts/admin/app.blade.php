<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}@yield('page_name')</title>

    <!-- Styles -->
    <link href="{{ elixir('css/admin.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @hook('admin.head')
</head>
<body>
<div id="loader">
    <div>
        <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
        Loading
    </div>
</div>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>{{ config('app.name') }}</span>Admin</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ $char->displayname }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" id="nav-dropdown">
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-times"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="header">Core</li>
        <li @if(uri_is('admin/dashboard')) class="active"@endif><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li @if(uri_is('admin/hooks*')) class="active"@endif><a href="{{ route('admin.hooks.index') }}"><i class="fa
        fa-paperclip"></i> Hooks</a></li>
        <li @if(uri_is('admin/modules')) class="active"@endif><a href="{{ route('admin.modules.index') }}"><i
                        class="fa fa-superpowers"></i> Modules</a></li>
        <li @if(uri_is('admin/settings*')) class="active"@endif><a href="{{ route('admin.settings.index') }}"><i class="fa fa-cogs"></i> Settings</a></li>
        <li role="presentation" class="divider"></li>
        <li class="header">Modules</li>
        @foreach($global_modules as $module)
            <li @if(uri_is_route('admin.modules.settings', ['id'=>$module->id]) === true) class="active" @endif>
                <a href="{{ route('admin.modules.settings', ['id'=>$module->id]) }}">
                    {!! $module->icon !!}
                    {{ $module->name }}
                </a>
            </li>
        @endforeach
        <li role="presentation" class="divider"></li>
        <li class="header"><a href="https://github.com/1e4/x" target="_blank">Version {{ env('version') }}</a></li>
    </ul>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div id="pjax-content">
        @include("admin.partials.breadcrumbs")


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page_name')</h1>
            </div>
        </div><!--/.row-->

        @if(session('success') !== null)
            <div class="row">
                <div class="small-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</div>	<!--/.main-->

<!-- Scripts -->
<script src="{{ elixir('js/vendor.js') }}"></script>
<script src="{{ elixir('js/admin.js') }}"></script>
</body>
</html>
