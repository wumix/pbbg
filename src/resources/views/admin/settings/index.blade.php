@extends('layouts.admin.layout')

@section('page_name')
    Settings
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="button-bar">
                <a href="{{ route('admin.settings.create') }}" class="btn btn-primary">Add new setting</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-header">
                    <h3 class="panel-heading">Current list of settings</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Setting</th>
                            <th>Value</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($settings as $setting)
                            <tr>
                                <td>{{ $setting->key }}</td>
                                <td>{{ $setting->value }}</td>
                                <td>
                                    {!! Form::xbuttonGroup([
                                        [
                                            'name'  =>  '<i class="fa fa-edit"></i> Edit',
                                            'link'  =>  route('admin.settings.edit', ['id'=>$setting->id])
                                        ],
                                        [
                                            'name'  =>  '<i class="fa fa-times"></i> Delete',
                                            'link'  =>  route('admin.settings.delete', ['id'=>$setting->id]),
                                            'class' =>  'btn-danger',
                                            'model' =>  'setting-' . $setting->id
                                        ]
                                    ]) !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="alert alert-info">
                                        There are no settings
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection