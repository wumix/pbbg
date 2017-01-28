<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-home"></i> Home</a></li>
        @for($i = 0; $i <= count(Request::segments()); $i++)
            @if(Request::segment($i) !== null && Request::segment($i) !== 'admin')
                <li>
                    @if(Request::segment($i + 1) !== null && Route::has('admin.' . Request::segment($i) . '.index'))
                        <a href="{{ route('admin.' . Request::segment($i) . '.index') }}">{{ ucfirst(Request::segment($i)) }}</a>
                    @else
                        {{ ucfirst(Request::segment($i)) }}
                    @endif
                </li>
            @endif
        @endfor
    </ol>
</div><!--/.row-->