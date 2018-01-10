<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'CHB') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('img/ico/favicon16.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/ico/favicon16.png') }}" type="image/x-icon">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="{{ asset('libs/lobipanel/lobipanel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/pace/flash.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/themify-icons/themify-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/flag-icon/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/toastr/toastr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css">

    @yield('css')

    {{--<script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};</script>--}}
</head>

<body class="hold-transition fixed sidebar-mini {{ Session::get('sidebar-toggle', '') }}" data-toggle="{{ route('ajax.sidebarToggle') }}">{{-- fixed --}}
<div class="wrapper">

    @include('layout._appHeader')

    @include('layout._appMainSidebar')

    <div class="content-wrapper">

        <section class="content-header">
            <div class="header-icon">
                @yield('header-icon', '<i class="pe-7s-close"></i>')
            </div>
            <div class="header-title">
                @section('header-title')
                    <h1>{{ trans('content.page.title') }}</h1>
                    <small>{{ trans('content.page.description') }}</small>
                @show
                <ol class="breadcrumb">
                    @section('breadcrumb')
                        <li><a href="{{ route('home') }}">{{ trans('sidebar.home') }}</a></li>
                    @show
                    {{--<li class="active">Breadcrumb</li>--}}
                </ol>
            </div>
        </section>

        <div class="content">
            @section('content')
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel panel-bd lobidrag">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4>This is page content</h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <p>You can create here any grid layout you want. And any variation layout you imagine:) Check out main dashboard and other site. It use many different layout. </p>
                            </div>
                            <div class="panel-footer">
                                This is standard panel footer
                            </div>
                        </div>
                    </div>
                </div>
            @show
        </div>

    </div>

    @include('layout._appFooter')

    <section id="toastr-messages" class="hover">
        @section('toastr-messages')
            @foreach(Session::pull('toastr-messages', []) as $notification)
                {!! $notification !!}
            @endforeach
        @show
    </section>




    <!-- VK Widget -->
    {{--<script type="text/javascript" src="//vk.com/js/api/openapi.js?144"></script>--}}
    {{--<div id="vk_community_messages"></div>--}}
    {{--<script type="text/javascript">--}}
        {{--VK.Widgets.CommunityMessages("vk_community_messages", 145398741, {disableButtonTooltip: "1"});--}}
    {{--</script>--}}
    <!-- VK Widget END -->


</div>

<script src="{{ asset('libs/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{ asset('libs/jquery-ui-1.12.1/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('libs/lobipanel/lobipanel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('libs/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('libs/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('libs/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('libs/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('libs/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
@section('js')
    <script src="{{ asset('js/layout.js') }}" type="text/javascript"></script>
@show


</body>
</html>