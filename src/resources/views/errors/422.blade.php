<!DOCTYPE html>
<html>
<head>
    <title>Permission denied.</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Permission denied.</div>
        @if(isset($permission))

            @if(isset($permission['permissions']))
                <h3>Required permissions: {{ $permission['permissions'] }}</h3>
            @endif

            @if(isset($permission['roles']))
                <h3>Required roles: {{ $permission['roles'] }}</h3>
            @endif
        @endif
    </div>
</div>
</body>
</html>
