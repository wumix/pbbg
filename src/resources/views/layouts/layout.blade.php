@if(!is_ajax())
    @include('layouts/admin')
@else
    <div id="pjax-content">
        <title>@yield('title')</title>
        @yield('content')
        @yield('scripts')
    </div>
@endif
