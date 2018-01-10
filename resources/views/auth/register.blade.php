@extends('layout.auth')

@section('content')

    <div class="login-wrapper">
        <div class="container-center lg">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-add-user"></i>
                        </div>
                        <div class="header-title">
                            <h3>{{ trans('form.register.title') }}</h3>
                            <small><strong>{{ trans('form.register.description') }}</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('register') }}" novalidate>
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="form-group col-lg-6{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name">{{ trans('form.label.first_name') }}</label>
                                <input type="text" tabindex="1" value="{{ old('first_name') }}" id="first_name" class="form-control" name="first_name" placeholder="">
                                @if($errors->has('first_name'))
                                    <span class="help-block small">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-lg-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">{{ trans('form.label.password') }}</label>
                                <input type="password" tabindex="4" value="" id="password" class="form-control" name="password">
                                @if($errors->has('password'))
                                    <span class="help-block small">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-lg-6{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname">{{ trans('form.label.surname') }}</label>
                                <input type="text"  tabindex="2" value="{{ old('surname') }}" id="surname" class="form-control" name="surname" placeholder="">
                                @if($errors->has('surname'))
                                    <span class="help-block small">{{ $errors->first('surname') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-lg-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password_confirmation">{{ trans('form.label.password_confirmation') }}</label>
                                <input type="password" tabindex="5" value="" id="password_confirmation" class="form-control" name="password_confirmation">
                            </div>

                            <div class="form-group col-lg-6{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">{{ trans('form.label.email') }}</label>
                                <input type="text" tabindex="3" value="{{ old('email') }}" id="email" class="form-control" name="email" placeholder="">
                                @if($errors->has('email'))
                                    <span class="help-block small">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="register">&nbsp;</label>
                                <button type="submit" tabindex="6" class="btn btn-block btn-success">
                                    {{ trans('form.button.register') }}
                                </button>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <hr>
                                <a class="btn btn btn-success btn-outline btn-rounded w-md m-b-5 pull-right" href="{{ route('login') }}">
                                    {{ trans('form.button.login') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
