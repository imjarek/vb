@extends('layout.app')

@section('header-icon')<i class="pe-7s-users"></i>@endsection

@section('header-title')
    <h1>{{ $headerTitle or trans('content.users.title.all') }}</h1>
    <small>{{ trans('content.users.description') }}</small>
@endsection

@section('breadcrumb') @parent <li class="active">{{ trans('sidebar.users') }}</li> @endsection

@section('js')
    <script>
        window.trans = {
            setUser:    '{{ trans('messages.users.modal.set_user') }}',
            setAdmin:   '{{ trans('messages.users.modal.set_admin') }}',
            setActive:  '{{ trans('messages.users.modal.set_active') }}',
            setBlocked: '{{ trans('messages.users.modal.set_blocked') }}',
            remove:     '{{ trans('messages.users.modal.remove') }}',
            ok:         '{{ trans('form.button.ok') }}',
            cancel:     '{{ trans('form.button.cancel') }}'
        };
    </script>
    @parent
    <script src="{{ asset('js/users.js') }}" type="text/javascript"></script>
@endsection

@section('content')

    @include('users._links')

    @include('users._search')

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd m-b-115">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>
                            {{ trans('content.users.table.title') }}
                            <span class="label label-default-outline p-b-0">
                                {{ $users->total() }}
                            </span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body p-0">

                    @include('users._table')

                    <div class="text-center">
                        @include('snippets._pagination', ['paginate' => $users, 'paginationClass' => 'm-t-25 m-b-20'])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
