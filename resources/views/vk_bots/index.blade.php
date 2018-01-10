@extends('layout.app')

@section('header-icon')<i class="fa fa-vk"></i>@endsection

@section('header-title')
    <h1>{{ $headerTitle or trans('content.vk_bots.title') }}</h1>
    <small>{{ trans('content.vk_bots.description') }}</small>
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ trans('sidebar.vk_bots') }}</li>
@endsection

@section('js')
    <script>
        window.trans = {
            remove:     '{{ trans('messages.vk_bot.modal.remove') }}',
            ok:         '{{ trans('form.button.remove') }}',
            cancel:     '{{ trans('form.button.cancel') }}'
        };
    </script>
    @parent
    <script src="{{ asset('js/vk-bots.js') }}" type="text/javascript"></script>
@endsection

@section('content')

    <a href="{{ route('bots.vk.create') }}" class="btn btn-success m-b-20">
        <span class="ti-plus"></span> {{ trans('form.button.chatbot') }}
    </a>

    <span class="text-muted pull-right p-t-5">
        <b>{{ trans('messages.callback_api.vk') }}:</b> <code>{{ route('callback_api.vk') }}</code>
    </span>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd m-b-115">
                <div class="panel-heading">
                    <h4>
                        {{ trans('content.vk_bots.title') }}
                        <span class="label label-default-outline p-b-0">
                            {{ $vkBots->count() }}
                        </span>
                    </h4>
                </div>
                <div class="panel-body p-0">
                    <table id="c-vk-bots-table" class="table table-condensed table-striped table-middle table-in-panel table-hover">
                        <thead>
                        <tr>
                            <th style="width: 50px">{{ trans('content.table.head.id') }}</th>
                            <th>{{ trans('content.table.head.name') }}</th>
                            <th>{{ trans('content.table.head.description') }}</th>
                            <th class="text-center">{{ trans('content.table.head.status') }}</th>
                            <th class="text-center">{{ trans('content.table.head.commands') }}</th>
                            <th>{{ trans('content.table.head.dates') }}</th>
                            <th style="width: 75px">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($vkBots as $vkBot)
                            <?php /** @var \App\Models\VkBot $vkBot */ ?>
                            <tr>
                                <td>{{ $vkBot->id }}</td>
                                <td>{{ $vkBot->name }}</td>
                                <td>{{ $vkBot->description }}</td>
                                <td class="text-center">
                                    @if($vkBot->enable)
                                        <span class="label label-success">On</span>
                                    @else
                                        <span class="label label-danger">Off</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $vkBot->commands->count() }}</td>
                                <td>
                                    <span class="ti-plus"></span> {{ \Carbon\Carbon::parse($vkBot->created_at)->format("d.m.Y") }}<br>
                                    <span class="ti-reload"></span> {{ \Carbon\Carbon::parse($vkBot->updated_at)->format("d.m.Y") }}
                                </td>

                                <td>
                                    <div class="btn-group{{ (!$loop->first && $loop->last) ? ' dropup' : '' }}">
                                        <button type="button" data-toggle="dropdown" class="btn dropdown-toggle btn-success">
                                            <span>
                                                {{ trans('content.table.head.action') }} <span class="caret"></span>
                                            </span>
                                        </button>
                                        <ul role="menu" class="dropdown-menu pull-right"
                                            data-id="{{ $vkBot->id }}"
                                            data-name="{{ $vkBot->name }}"
                                            data-url="{{ route('bots.vk.remove_in_trash', ['id' => $vkBot->id]) }}"
                                        >
                                            <li>
                                                <a href="{{ route('bots.vk.edit', ['id' => $vkBot->id]) }}">
                                                    <span class="ti-pencil-alt color-green"></span> {{ trans('form.button.edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('bots.vk.list_command', ['id_bot' => $vkBot->id]) }}">
                                                    <span class="ti-pencil-alt color-green"></span> {{ trans('form.button.commands') }}
                                                </a>
                                            </li>
                                            @if($vkBot->enable && $vkBot->widget)
                                            <li>
                                                <a href="{{ route('bots.vk.test', ['id' => $vkBot->id]) }}">
                                                    <span class="ti-comment-alt color-green"></span> {{ trans('form.button.test') }}
                                                </a>
                                            </li>
                                            @endif
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