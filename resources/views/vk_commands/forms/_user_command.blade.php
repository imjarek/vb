<p class="text-center">
    <strong>{{ trans('form.button.user_command') }}</strong><br>
    ({{ trans('form.commands.description.user_command') }}:
    <code>/command</code>, <code>/command-1</code>, <code>/command_2</code>)
</p>

<form action="{{ route('bots.vk.save_command', ['id_bot' => $vkBot->id, 'id_com' => (int)$command->id]) }}" method="POST">

    {{ csrf_field() }}

    <input type="hidden" name="type" value="user">

    <div class="form-group row{{ $errors->has('command') ? ' has-error' : '' }}">
        <label for="command" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.command') }}</label>
        <div class="col-sm-9">
            <input type="text" name="command" value="{{ old('command', $command->command) }}" id="command" class="form-control" autocomplete="off" placeholder="">
            @if($errors->has('command'))
                <span class="help-block small">{{ $errors->first('command') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.description') }}</label>
        <div class="col-sm-9">
            <input type="text" name="description" value="{{ old('description', $command->description) }}" id="description" class="form-control" autocomplete="off" placeholder="">
            @if($errors->has('description'))
                <span class="help-block small">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row{{ $errors->has('message') ? ' has-error' : '' }}">
        <label for="message" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.message') }}</label>
        <div class="col-sm-9">
            <textarea name="message" id="message" rows="5" class="form-control" placeholder="" style="resize: none">{{ old('message', $command->message) }}</textarea>
            @if($errors->has('message'))
                <span class="help-block small">{{ $errors->first('message') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row{{ $errors->has('enable') ? ' has-error' : '' }}">
        <label class="col-sm-3 col-form-label p-t-5">&nbsp;</label>
        <div class="col-sm-9">
            <label for="enable">
                <input name="enable" type="checkbox" {{ old('enable', !empty($command->enable)) ? 'checked' : '' }} value="1" class="i-check" data-theme="square-green" id="enable">
                &nbsp;{{ trans('form.label.enable') }}
            </label>
            @if($errors->has('enable'))
                <span class="help-block small">{{ $errors->first('enable') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="example-time-input" class="col-sm-3 col-form-label">&nbsp;</label>
        <div class="col-sm-9">
            <button type="submit" class="btn btn-block btn-success">
                @if($command->id)
                    {{ trans('form.button.update') }}
                @else
                    {{ trans('form.button.save') }}
                @endif
            </button>
        </div>
    </div>
</form>