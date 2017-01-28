@extends('layouts.admin.layout')
@section('page_name')Hooks @endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-header">
                    <h3 class="panel-heading">Installed Hooks</h3>
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
                        @foreach($a_hooks as $hook)
                            <tr>
                                <td>{{ $hook->name }}</td>
                                <td>{{ $hook->meta->author->name }}</td>
                                <td>{{ $hook->meta->meta->description }}</td>
                                <td>{{ $hook->meta->meta->version }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.hooks.settings', ['id'=>$hook->id]) }}"><i class="fa fa-edit"></i> Settings</a>
                                    <button onclick="Form.submit('#form-disable-{{ $hook->id }}')" class="btn btn-warning"><i class="fa fa-stop-circle"></i> Disable</button>
                                    {{ Form::xopen(['url'=>route('admin.hooks.disable', ['id'=>$hook->id]), 'id'=>"form-disable-{$hook->id}"]) }}
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
                    <h3 class="panel-heading">Available Hooks</h3>
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
                        @if(property_exists($u_hooks, 'hooks'))
                        @foreach($u_hooks->hooks as $hook)
                            <tr>
                                <td>{{ $hook['meta']->name }}</td>
                                <td>{{ $hook['author']->name }}</td>
                                <td>{{ $hook['meta']->description }}</td>
                                <td>{{ $hook['meta']->version }}</td>
                                <td>
                                    <button onclick='Form.submit("#form-install-{{ str_slug($hook['meta']->name) }}");' class="btn btn-success"><i class="fa fa-cloud-upload"></i> Install</button>

                                    {{ Form::xopen(['url'=>route('admin.hooks.install', ['name'=>$hook['meta']->name]), 'id'=>"form-install-" . str_slug($hook['meta']->name)]) }}
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