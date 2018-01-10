@extends('layout.auth')

@section('content')
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-refresh-2"></i>
                        </div>
                        <div class="header-title">
                            <h3>{{ trans('form.email_password.title') }}</h3>
                            <small><strong>{{ trans('form.email_password.description') }}</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <p>{{ trans('form.email_password.text') }}</p>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label" for="email">{{ trans('form.label.email') }}</label>
                            <input type="text" placeholder="" required="" value="{{ old('email') }}" name="email" id="email" class="form-control">
                            @if($errors->has('email'))
                                <span class="help-block small">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="btn btn-block btn-success w-md m-b-5">
                                {{ trans('form.button.reset_password') }}
                            </button>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-block btn-success btn-outline btn-rounded w-md m-b-5" href="{{ route('login') }}">
                                    {{ trans('form.button.login') }}
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-block btn-success btn-outline btn-rounded w-md m-b-5" href="{{ route('register') }}">
                                    {{ trans('form.button.register') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
