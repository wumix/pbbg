@extends('layouts.admin.layout')

@section('page_name')Dashboard @endsection
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-widget">
                <div class="icon blue">
                    <i class="fa fa-2x fa-magic"></i>
                </div>
                <div class="stat">
                    <div class="large">{{ env('version') }}</div>
                    <div class="text-muted">@if(env('version') != 0.1)Upgrade Now @else Latest version @endif</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-widget">
                <div class="icon orange">
                    <i class="fa fa-2x fa-magic"></i>
                </div>
                <div class="stat">
                    <div class="large">120</div>
                    <div class="text-muted">Plugins Available</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-widget">
                <div class="icon blue">
                    <i class="fa fa-2x fa-magic"></i>
                </div>
                <div class="stat">
                    <div class="large">120</div>
                    <div class="text-muted">Plugins Activated</div>
                </div>
            </div>
        </div>
    </div>
@endsection