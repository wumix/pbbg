@extends('layouts.admin.layout')

@section('page_name')Delete setting @endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    {{ Form::open([
                        'route'    =>  ['admin.settings.destroy', $setting->id],
                        'data-pjax',
                        'method'    =>  'DELETE'
                    ]) }}

                    <div class="alert alert-warning">
                        Are you sure you want to delete this setting?
                    </div>

                    {!! Form::xsubmit('<i class="fa fa-times"></i> Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection