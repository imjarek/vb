@extends('layout.auth')

@section('content')
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-unlock"></i>
                        </div>
                        <div class="header-title">
                            <h3>{{ trans('form.login.title') }}</h3>
                            <small><strong>{{ trans('form.login.description') }}</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('login') }}" method="POST" id="loginForm" novalidate>
                        {{ csrf_field() }}

                        @if($message = Session::pull('auth.error', ''))
                            <div class="alert {{ Session::pull('auth.class', 'alert-danger') }} alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ $message }}
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label" for="email">{{ trans('form.label.email') }}</label>
                            <input type="text" required="" value="{{ old('email') }}" name="email" id="email" class="form-control">
                            @if ($errors->has('email'))
                                <span class="help-block small">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="control-label" for="password">{{ trans('form.label.password') }}</label>
                            <input type="password" required="" value="" name="password" id="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="help-block small">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="remember">
                                <input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} class="i-check" data-theme="square-green" id="remember">
                                {{ trans('form.label.remember') }}
                            </label>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-block btn-success w-md m-b-5">
                                {{ trans('form.button.login') }}
                            </button>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-block btn-success btn-outline btn-rounded w-md m-b-5" href="{{ route('register') }}">
                                    {{ trans('form.button.register') }}
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-block btn-success btn-outline btn-rounded w-md m-b-5" href="{{ route('password.request') }}">
                                    {{ trans('form.button.reset_password') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
