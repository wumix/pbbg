@extends('layouts.admin.layout')
@section('page_name')Modules @endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-header">
                    <h3 class="panel-heading">Installed Modules</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-striped table-v-align">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Version</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($a_modules as $module)
                            <tr>
                                <td>{{ $module->name }}</td>
                                <td>{{ $module->meta->author->name }}</td>
                                <td>{{ $module->meta->meta->description }}</td>
                                <td>{{ $module->meta->meta->version }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.modules.settings', ['id'=>$module->id]) }}"><i class="fa fa-edit"></i> Settings</a>
                                    <button onclick="Form.submit('#form-disable-{{ $module->id }}')" class="btn btn-warning"><i class="fa fa-stop-circle"></i> Disable</button>
                                    {{ Form::xopen(['url'=>route('admin.modules.disable', ['id'=>$module->id]), 'id'=>"form-disable-{$module->id}"]) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-header">
                    <h3 class="panel-heading">Available Modules</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover table-striped table-v-align">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Version</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(property_exists($u_modules, 'modules'))
                            @foreach($u_modules->modules as $module)
                                <tr>
                                    <td>{{ $module['meta']->name }}</td>
                                    <td>{{ $module['author']->name }}</td>
                                    <td>{{ $module['meta']->description }}</td>
                                    <td>{{ $module['meta']->version }}</td>
                                    <td>
                                        <button onclick='Form.submit("#form-install-{{ str_slug($module['meta']->name) }}");' class="btn btn-success"><i class="fa fa-cloud-upload"></i> Install</button>

                                        {{ Form::xopen(['url'=>route('admin.modules.install', ['name'=>$module['meta']->name]), 'id'=>"form-install-" . str_slug($module['meta']->name)]) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection