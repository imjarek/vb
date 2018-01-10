@extends('layout.app')

@section('header-icon')<i class="fa fa-vk"></i>@endsection

@section('header-title')
    <h1>{{ $headerTitle or trans('content.vk_bots.test.title') }}</h1>
    <small>{{ trans('content.vk_bots.description') }}</small>
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('bots.vk') }}">{{ trans('sidebar.vk_bots') }}</a></li>
    <li class="active">{{ trans('content.vk_bots.test.breadcrumb') }}</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>
                            {{ trans('content.vk_bots.test.table.title') }}
                            <span class="label label-default-outline p-b-0">
                                {{ $commands->count() }}
                            </span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body p-0">
                    <table id="c-commands-table" class="table table-condensed table-striped table-middle table-in-panel table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('content.table.head.command') }}</th>
                            <th style="width: 50px">{{ trans('content.table.head.type') }}</th>
                            <th>{{ trans('form.label.message') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($commands as $command)
                            <?php /** @var \App\Models\Command $command */ ?>
                            <tr>
                                <td><code>{{ $command->command }}</code></td>
                                <td class="text-center">{{ $command->type }}</td>
                                <td>
                                    <small>{{ str_limit($command->message, 300) }}</small>
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

    {!! $vkBot->widget !!}

@endsection