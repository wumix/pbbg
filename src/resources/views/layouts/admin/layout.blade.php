@if(!is_ajax())
    @extends('layouts.admin.app')
@else
    <div id="pjax-content">
        @include("admin.partials.breadcrumbs")
        <title>{{ config('app.name') }} @yield('page_name')</title>

        @hook('admin.page.header.before')

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page_name')</h1>
            </div>
        </div><!--/.row-->

        @hook('admin.page.header.after')

        @if(session('success') !== null)
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

@endif
