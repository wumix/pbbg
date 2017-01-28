@extends('layouts.admin.layout')

@section('page_name')Edit Settings @endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    {{ Form::model($setting, [
                        'route'    =>  ['admin.settings.update', $setting->id],
                        'data-pjax',
                        'method'    =>  'PUT'
                    ]) }}

                    @include('admin.settings.create-edit-form')

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection