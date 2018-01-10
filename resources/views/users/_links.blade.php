@php($currentRoute = Route::currentRouteName())

<div class="row m-b-20">

    <div class="col-lg-2">
        <a href="{{ route('users') }}" class="btn btn-block btn-sm {{ $currentRoute === 'users' ? 'btn-info' : 'btn-default' }}">
            {{ trans('content.users.links.all') }}
        </a>
    </div>

    <div class="col-lg-2">
        <a href="{{ route('users.new') }}" class="btn btn-block btn-sm {{ $currentRoute === 'users.new' ? 'btn-warning' : 'btn-default' }}">
            {{ trans('content.users.links.new') }}
        </a>
    </div>

    <div class="col-lg-2">
        <a href="{{ route('users.active') }}" class="btn btn-block btn-sm {{ $currentRoute === 'users.active' ? 'btn-success' : 'btn-default' }}">
            {{ trans('content.users.links.active') }}
        </a>
    </div>

    <div class="col-lg-2">
        <a href="{{ route('users.blocked') }}" class="btn btn-block btn-sm {{ $currentRoute === 'users.blocked' ? 'btn-danger' : 'btn-default' }}">
            {{ trans('content.users.links.blocked') }}
        </a>
    </div>

    <div class="col-lg-2">
        <a href="{{ route('users.admin') }}" class="btn btn-block btn-sm  {{ $currentRoute === 'users.admin' ? 'btn-violet' : 'btn-default' }}">
            {{ trans('content.users.links.admin') }}
        </a>
    </div>

</div>