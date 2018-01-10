<hr>

<h3>{{ trans('form.profile.password.title') }}</h3>

<form method="post" action="{{ route('profile.update.password') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('password_old') ? ' has-error' : '' }}">
        <label for="password_old">{{ trans('form.label.password_old') }}</label>
        <input type="password" class="form-control" name="password_old" autocomplete="off" placeholder="">
        @if($errors->has('password_old'))<span class="help-block small">{{ $errors->first('password_old') }}</span>@endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password">{{ trans('form.label.password_new') }}</label>
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="">
        @if($errors->has('password'))<span class="help-block small">{{ $errors->first('password') }}</span>@endif
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password_confirmation">{{ trans('form.label.password_confirmation') }}</label>
        <input type="password" class="form-control" name="password_confirmation" autocomplete="off" placeholder="">
        @if($errors->has('password_confirmation'))<span class="help-block small">{{ $errors->first('password_confirmation') }}</span>@endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success pull-right">{{ trans('form.button.save') }}</button>
        <div class="clearfix"></div>
    </div>
</form>