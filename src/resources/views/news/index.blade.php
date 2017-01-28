@extends('layouts/layout')

@section('title')
    News
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">

            <p class="alert alert-info">
                No news has been posted yet
            </p>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function()
        {
            console.log('done')
        })
    </script>
@endsection