<table id="c-users-table" class="table table-condensed table-striped table-middle table-in-panel table-hover">
    <thead>
    <tr>

        <th style="width: 50px">{{ trans('content.table.head.id') }}</th>
        <th style="width: 75px">{{ trans('content.table.head.logo') }}</th>
        <th>{{ trans('content.table.head.name_email') }}</th>
        <th>{{ trans('content.table.head.status') }}</th>
        <th>{{ trans('content.table.head.password') }}</th>
        <th>{{ trans('content.table.head.dates') }}</th>
        <th style="width: 75px">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td><img src="{{ $user->urlLogo() }}" class="img img-circle" height="40" width="40" alt=""></td>
            <td>{{ $user->fio(false) }}<br><small><a href="mailto:{{ $user->email }}" target="_blank">{{ $user->email }}</a></small></td>
            <td>
                <span class="label label-{{ $user->statusColor() }}">{{ $user->statusStr() }}</span>
                <span class="label label-{{ $user->roleColor() }}">{{ $user->roleStr() }}</span>
            </td>
            <td>{{ $user->de_password }}</td>
            <td>
                <span class="ti-plus"></span> {{ \Carbon\Carbon::parse($user->created_at)->format("d.m.Y") }}<br>
                <span class="ti-reload"></span> {{ \Carbon\Carbon::parse($user->updated_at)->format("d.m.Y") }}
            </td>

            <td>
                <div class="btn-group{{ (!$loop->first && $loop->last) ? ' dropup' : '' }}">
                    <button type="button" data-toggle="dropdown" class="btn dropdown-toggle btn-success">
                        <span>
                            {{ trans('content.table.head.action') }}
                            <span class="caret"></span>
                        </span>
                    </button>
                    <ul role="menu" class="dropdown-menu pull-right"
                        data-id="{{ $user->id }}"
                        data-fio="{{ $user->fio(false) }}"
                        data-email="{{ $user->email }}"
                        data-link="{{ route('users.update') }}"
                    >
                        @if($user->status !== 1)
                            <li>
                                <a href="#" class="c-btn-set-active">
                                    <span class="ti-unlock color-green"></span> {{ trans('form.button.users.set_active') }}
                                </a>
                            </li>
                        @endif
                        @if($user->status !== 2)
                            <li>
                                <a href="#" class="c-btn-set-blocked">
                                    <span class="ti-lock color-red"></span> {{ trans('form.button.users.set_blocked') }}
                                </a>
                            </li>
                        @endif
                            <li class="divider"></li>
                        @if($user->hasRole('admin'))
                            <li>
                                <a href="#" class="c-btn-set-user">
                                    <span class="ti-minus color-green"></span> {{ trans('form.button.users.set_user') }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="#" class="c-btn-set-admin">
                                    <span class="ti-plus color-green"></span> {{ trans('form.button.users.set_admin') }}
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