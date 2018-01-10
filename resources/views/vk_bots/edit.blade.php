@extends('layout.app')

@section('header-icon')<i class="fa fa-vk"></i>@endsection

@section('header-title')
    @if(empty($vkBot))
        <h1>{{ $headerTitle or trans('content.vk_bots.create.title') }}</h1>
    @else
        <h1>{{ $headerTitle or trans('content.vk_bots.edit.title') }}</h1>
    @endif
    <small>{{ trans('content.vk_bots.description') }}</small>
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('bots.vk') }}">{{ trans('sidebar.vk_bots') }}</a></li>
    @if(empty($vkBot))
        <li class="active">{{ trans('content.vk_bots.create.breadcrumb') }}</li>
    @else
        <li class="active">{{ trans('content.vk_bots.edit.breadcrumb') }}</li>
    @endif
@endsection

@section('css')
    <link href="{{ asset('libs/icheck/skins/all.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{ asset('libs/icheck/icheck.min.js') }}" type="text/javascript"></script>
    @parent
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd">
            <div class="panel-heading p-0"></div>
            <div class="panel-body">
                <form action="{{ route('bots.vk.save', ['id' => empty($vkBot) ? 0 : $vkBot->id]) }}" method="POST">

                    {{ csrf_field() }}

                    <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" value="{{ old('name', empty($vkBot->name) ? '' : $vkBot->name) }}" id="name" class="form-control" autocomplete="off" placeholder="">
                            @if($errors->has('name'))
                                <span class="help-block small">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.description') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="description" value="{{ old('description', empty($vkBot->description) ? '' : $vkBot->description) }}" id="description" autocomplete="off" class="form-control" placeholder="">
                            @if($errors->has('description'))
                                <span class="help-block small">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('id_group') ? ' has-error' : '' }}">
                        <label for="id_group" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.vk.id_group') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="id_group" value="{{ old('id_group', empty($vkBot->id_group) ? '' : $vkBot->id_group) }}" id="id_group" autocomplete="off" class="form-control" placeholder="">
                            @if($errors->has('id_group'))
                                <span class="help-block small">{{ $errors->first('id_group') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('vk_key') ? ' has-error' : '' }}">
                        <label for="vk_key" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.vk.vk_key') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="vk_key" value="{{ old('vk_key', empty($vkBot->vk_key) ? '' : $vkBot->vk_key) }}" id="vk_key" autocomplete="off" class="form-control" placeholder="">
                            @if($errors->has('vk_key'))
                                <span class="help-block small">{{ $errors->first('vk_key') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('secret_key') ? ' has-error' : '' }}">
                        <label for="secret_key" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.vk.secret_key') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="secret_key" value="{{ old('secret_key', empty($vkBot->secret_key) ? '' : $vkBot->secret_key) }}" id="secret_key" autocomplete="off" class="form-control" placeholder="">
                            @if($errors->has('secret_key'))
                                <span class="help-block small">{{ $errors->first('secret_key') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('response_api') ? ' has-error' : '' }}">
                        <label for="response_api" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.vk.response_api') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="response_api" value="{{ old('response_api', empty($vkBot->response_api) ? '' : $vkBot->response_api) }}" id="response_api" autocomplete="off" class="form-control" placeholder="">
                            @if($errors->has('response_api'))
                                <span class="help-block small">{{ $errors->first('response_api') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('widget') ? ' has-error' : '' }}">
                        <label for="widget" class="col-sm-3 col-form-label p-t-5">{{ trans('form.label.vk.widget') }}</label>
                        <div class="col-sm-9">
                            <textarea name="widget" id="widget" rows="5" class="form-control" placeholder="" style="resize: none">{{ old('widget', empty($vkBot->widget) ? '' : $vkBot->widget) }}</textarea>
                            @if($errors->has('widget'))
                                <span class="help-block small">{{ $errors->first('widget') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('enable') ? ' has-error' : '' }}">
                        <label class="col-sm-3 col-form-label p-t-5">&nbsp;</label>
                        <div class="col-sm-9">
                            <label for="enable">
                                <input name="enable" type="checkbox" {{ old('enable', !empty($vkBot->enable)) ? 'checked' : '' }} value="1" class="i-check" data-theme="square-green" id="enable">
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
                                @if(empty($vkBot))
                                    {{ trans('form.button.save') }}
                                @else
                                    {{ trans('form.button.update') }}
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection