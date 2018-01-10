<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ChatBot</title>

    <link rel="icon" href="{{ asset('img/ico/favicon16.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/ico/favicon.png') }}" type="image/x-icon">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/icheck/skins/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/toastr/toastr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    @yield('content')

    <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/layout.js') }}" type="text/javascript"></script>

</body>
</html>