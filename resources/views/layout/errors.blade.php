<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '404')</title>

    <link rel="icon" href="{{ asset('img/ico/favicon16.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/ico/favicon.png') }}" type="image/x-icon">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="middle-box">

        @yield('content')

    </div>

    <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
</body>
</html>