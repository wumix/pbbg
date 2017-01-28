@extends('layouts.admin.layout')

@section('page_name')Create a new entry @endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    {{ Form::open([
                        'route'    =>  'admin.settings.store',
                        'data-pjax',
                        'method'    =>  'POST'
                    ]) }}

                        @include('admin.settings.create-edit-form')

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection