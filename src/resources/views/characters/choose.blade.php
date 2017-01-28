@extends('layouts.app')

@section('content')
    <div class="container">
        @if($characters->count() === 0)

            <div class="row">
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                Create a new character
                            </h2>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('characters.create') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('displayname') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Display Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="displayname" value="{{ old('displayname') }}" required autofocus>

                                        @if ($errors->has('displayname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('displayname') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Start your new journey
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Your Characters</div>

                        <div class="panel-body">
                            <form action="{{ route('characters.choose') }}" method="post">
                                {{ csrf_field() }}
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Banned</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($characters as $character)
                                        <tr>
                                            <td>{{ $character->displayname }}</td>
                                            <td>{{ $character->banned }}</td>
                                            <td>{{ $character->created_at }}</td>
                                            <td>
                                                @if($character->banned !== 1)
                                                    <button type="submit" name="cid" value="{{ $character->id }}" class="btn btn-default">
                                                        Play
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
