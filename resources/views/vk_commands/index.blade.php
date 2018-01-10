@extends('layout.app')

@section('header-icon')<i class="fa fa-vk"></i>@endsection

@section('header-title')
    <h1>{{ $headerTitle or trans('content.vk_commands.title') }}</h1>
    <small>{{ $vkBot->name }}</small>
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('bots.vk') }}">{{ trans('sidebar.vk_bots') }}</a></li>
    <li class="active">{{ trans('content.vk_commands.title') }}</li>
@endsection

@section('js')
    <script>
        window.trans = {
            remove:      '{{ trans('messages.commands.modal.remove') }}',
            remove_info: '{{ trans('messages.commands.modal.remove_info') }}',
            ok:          '{{ trans('form.button.remove') }}',
            cancel:      '{{ trans('form.button.cancel') }}'
        };
    </script>
    @parent
    <script src="{{ asset('js/commands.js') }}" type="text/javascript"></script>
@endsection

@section('content')

    <a href="{{ route('bots.vk.user_command',['id_bot' => $vkBot->id]) }}" class="btn btn-success m-b-20">
        <span class="ti-plus"></span> {{ trans('form.button.user_command') }}
    </a>

    <a href="{{ route('bots.vk.sys_command',['id_bot' => $vkBot->id]) }}" class="btn btn-success m-b-20">
        <span class="ti-plus"></span> {{ trans('form.button.sys_command') }}
    </a>

    <a href="{{ route('bots.vk.bw_command',['id_bot' => $vkBot->id]) }}" class="btn btn-success m-b-20">
        <span class="ti-plus"></span> {{ trans('form.button.bw_command') }}
    </a>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd m-b-100">
                <div class="panel-heading">
                    <h4>
                        {{ trans('content.vk_bots.test.table.title') }}
                        <span class="label label-default-outline p-b-0">
                        {{ $commands->count() }}
                    </span>
                    </h4>
                </div>
                <div class="panel-body p-0">
                    <table id="c-commands-table" class="table table-condensed table-striped table-middle table-in-panel table-hover">
                        <thead>
                        <tr>
                            {{--<th style="width: 50px">{{ trans('content.table.head.id') }}</th>--}}
                            <th>{{ trans('content.table.head.command') }}</th>
                            <th style="width: 50px">{{ trans('content.table.head.type') }}</th>
                            <th>{{ trans('form.label.message') }}</th>
                            <th class="text-center">{{ trans('content.table.head.status') }}</th>
                            <th>{{ trans('content.table.head.dates') }}</th>
                            <th style="width: 75px">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($commands as $command)
                            <?php /** @var \App\Models\Command $command */ ?>
                            <tr>
                                {{--<td>{{ $command->id }}</td>--}}
                                <td><code>{{ $command->command }}</code></td>
                                <td class="text-center">{{ $command->type }}</td>
                                <td title="{{ $command->message }}">
                                    <small>{!! str_limit($command->message) !!}</small>
                                </td>
                                <td class="text-center">
                                    {!! $command->enable ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>' !!}
                                </td>
                                <td>
                                    <span class="ti-plus"></span> {{ \Carbon\Carbon::parse($command->created_at)->format("d.m.Y") }}<br>
                                    <span class="ti-reload"></span> {{ \Carbon\Carbon::parse($command->updated_at)->format("d.m.Y") }}
                                </td>

                                <td>
                                    <div class="btn-group{{ (!$loop->first && $loop->last) ? ' dropup' : '' }}">
                                        <button type="button" data-toggle="dropdown" class="btn dropdown-toggle btn-success">
                                        <span>
                                            {{ trans('content.table.head.action') }} <span class="caret"></span>
                                        </span>
                                        </button>
                                        <ul role="menu" class="dropdown-menu pull-right" data-id="{{ $command->id }}" data-remove="{{ route('bots.command.remove', ['id_com' => $command->id]) }}">
                                            <li>
                                                <a href="{{ $command->getUrlEditVk() }}">
                                                    <span class="ti-pencil-alt color-green"></span> {{ trans('form.button.edit') }}
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" class="c-btn-remove">
                                                    <span class="ti-trash color-red"></span> {{ trans('form.button.remove') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <h1 class="text-center text-muted m-t-50 m-b-50">
                                        {{ trans('content.empty') }}
                                    </h1>
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