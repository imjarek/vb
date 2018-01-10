<p class="text-center">
    <strong>{{ trans('form.button.sys_command') }}</strong><br>
    ({{ trans('form.commands.description.sys_command') }})
</p>

<form action="{{ route('bots.vk.save_command', ['id_bot' => $vkBot->id, 'id_com' => (int)$command->id]) }}" method="POST">

    {{ csrf_field() }}

    <input type="hidden" name="type" value="sys">

    <div class="form-group row{{ $errors->has('command') ? ' has-error' : '' }}">
        <label for="command" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.command') }}</label>
        <div class="col-sm-9">
            <select name="command" id="command" class="form-control">
                @foreach(\App\Models\VkBot::$sysCommands as $sysCommand)
                    <option value="${{ $sysCommand }}" {{ old('command', $command->command) === "$".$sysCommand ? "selected=selected" : '' }}>
                        {{ trans("sys_command.{$sysCommand}") }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('command'))
                <span class="help-block small">{{ $errors->first('command') }}</span>
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