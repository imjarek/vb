@extends('layout.auth')

@section('content')
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-key"></i>
                        </div>
                        <div class="header-title">
                            <h3>Сброс пароля</h3>
                            <small><strong>Пожалуйста, заполните форму для изменения пароля</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <p>Введите новый пароль.</p>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label" for="email">Email</label>
                            <input type="text" placeholder="" required="" value="{{ $email or old('email') }}" name="email" id="email" class="form-control">
                            @if($errors->has('email'))
                                <span class="help-block small">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Новый пароль</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block small">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Повторите пароль</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="btn btn-block btn-success w-md m-b-5">Сбросить пароль</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
