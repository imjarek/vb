@extends('layout.app')

@section('header-icon')<i class="fa fa-vk"></i>@endsection

@section('header-title')
    @if($command->id)
        <h1>{{ $headerTitle or trans('content.vk_commands.edit.title') }}</h1>
    @else
        <h1>{{ $headerTitle or trans('content.vk_commands.create.title') }}</h1>
    @endif
    <small>{{ $vkBot->name }}</small>
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('bots.vk') }}">{{ trans('sidebar.vk_bots') }}</a></li>
    <li><a href="{{ route('bots.vk.list_command',['id_bot' => $vkBot->id]) }}">{{ trans('content.vk_commands.title') }}</a></li>
    @if($command->id)
        <li class="active">{{ trans('content.vk_commands.edit.breadcrumb') }}</li>
    @else
        <li class="active">{{ trans('content.vk_commands.create.breadcrumb') }}</li>
    @endif
@endsection

@section('css')
    <link href="{{ asset('libs/icheck/skins/all.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{ asset('libs/icheck/icheck.min.js') }}" type="text/javascript"></script>
    @parent
@endsection

@php
    $currentRoute = Route::currentRouteName();
@endphp

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 m-b-20">

            <div class="col-xs-9 p-0">
                <div class="tab-content">

                    <div class="tab-pane fade in active">
                        <div class="panel-body">

                            @if($currentRoute === 'bots.vk.user_command')

                                @include('vk_commands.forms._user_command')

                            @elseif($currentRoute === 'bots.vk.sys_command')

                                @include('vk_commands.forms._sys_command')

                            @elseif($currentRoute === 'bots.vk.bw_command')

                                @include('vk_commands.forms._bw_command')

                            @endif

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xs-3 p-0">
                <ul class="nav nav-tabs tabs-right">

                    <li class="{{ $currentRoute === 'bots.vk.user_command' ? 'active' : '' }}">
                        <a href="{{ route('bots.vk.user_command', ['id_bot' => $vkBot->id, 'id_com' => $type === 'user' ? $command->id : 0]) }}">
                            {{ trans('form.button.user_command') }}
                        </a>
                    </li>
                    <li class="{{ $currentRoute === 'bots.vk.sys_command' ? 'active' : '' }}">
                        <a href="{{ route('bots.vk.sys_command', ['id_bot' => $vkBot->id, 'id_com' => $type === 'sys' ? $command->id : 0]) }}">
                            {{ trans('form.button.sys_command') }}
                        </a>
                    </li>
                    <li class="{{ $currentRoute === 'bots.vk.bw_command' ? 'active' : '' }}">
                        <a href="{{ route('bots.vk.bw_command', ['id_bot' => $vkBot->id, 'id_com' => $type === 'bw' ? $command->id : 0]) }}">
                            {{ trans('form.button.bw_command') }}
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </div>

    @include('vk_commands._snippets')

@endsection