@extends('layout.app')

@section('header-icon')<i class="fa fa-vk"></i>@endsection

@section('header-title')
    <h1>{{ $headerTitle or trans('content.vk_bots.trash.title') }}</h1>
    <small>{{ trans('content.vk_bots.description') }}</small>
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ trans('content.vk_bots.trash.breadcrumb') }}</li>
@endsection

@section('js')
    <script>
        window.trans = {
            remove:     '{{ trans('messages.vk_bot.modal.remove') }}',
            restore:    '{{ trans('messages.vk_bot.modal.restore') }}',
            ok:         '{{ trans('form.button.ok') }}',
            cancel:     '{{ trans('form.button.cancel') }}'
        };
    </script>
    @parent
    <script src="{{ asset('js/vk-bots-trash.js') }}" type="text/javascript"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd m-b-100">
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
                                    <span class="ti-trash"></span> {{ \Carbon\Carbon::parse($vkBot->deleted_at)->format("d.m.Y") }}
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
                                            data-restore="{{ route('admin.bots.vk.restore', ['id' => $vkBot->id]) }}"
                                            data-remove="{{ route('admin.bots.vk.remove_with_trash', ['id' => $vkBot->id]) }}"
                                        >
                                            <li>
                                                <a href="#" class="c-btn-restore">
                                                    <span class="ti-back-right color-green"></span> {{ trans('form.button.restore') }}
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