<hr class="visible-xs visible-sm">

<h3>{{ trans('form.profile.data.title') }}</h3>

<form method="post" action="{{ route('profile.update') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
        <label for="first_name">{{ trans('form.label.first_name') }}</label>
        <input type="text" class="form-control" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" autocomplete="off" placeholder="">
        @if($errors->has('first_name'))<span class="help-block small">{{ $errors->first('first_name') }}</span>@endif
    </div>
    <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
        <label for="surname">{{ trans('form.label.surname') }}</label>
        <input type="text" class="form-control" name="surname" value="{{ old('surname', Auth::user()->surname) }}" autocomplete="off" placeholder="">
        @if($errors->has('surname'))<span class="help-block small">{{ $errors->first('surname') }}</span>@endif
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">{{ trans('form.label.email') }}</label>
        <input type="email" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="" autocomplete="off" readonly="">
        @if($errors->has('email'))<span class="help-block small">{{ $errors->first('email') }}</span>@endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success pull-right">{{ trans('form.button.save') }}</button>
        <div class="clearfix"></div>
    </div>
</form>