<h3 class="visible-md visible-lg">{{ trans('form.profile.logo.title') }}</h3>

<div id="block-user-logo">
    <img src="{{ Auth::user()->urlLogo() }}" class="img img-rounded pull-left user-logo" width="150" alt="">
    <div class="m-l-170">
        <input type="file" class="c-btn-upload-image hidden" data-token="{{ csrf_token() }}" data-action="{{ route('upload.tmp.image') }}" id="upload">
        <label class="btn btn-default" for="upload">
            <span class="visible-md visible-lg"><span class="ti-upload"></span> {{ trans('form.button.upload_logo.small') }}</span>
            <span class="visible-xs visible-sm"><span class="ti-upload"></span> {{ trans('form.button.upload_logo.long') }}</span>
        </label>
        <span id="status"></span>
    </div>
</div>

<div id="block-user-logo-crop" style="display: none">
    <div class="row">
        <div class="col-xs-12 m-b-20">
            <img src="{{ Auth::user()->urlLogo() }}" class="img img-responsive user-logo" alt="">
        </div>
        <div class="col-xs-12">
            <form id="form-crop-logo" action="{{ route('profile.update.logo') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="file" value="" placeholder="">
                <input type="hidden" name="x" value="" placeholder="">
                <input type="hidden" name="y" value="" placeholder="">
                <input type="hidden" name="width" value="" placeholder="">
                <input type="hidden" name="height" value="" placeholder="">
                <input type="hidden" name="rotate" value="" placeholder="">
                <input type="hidden" name="scaleX" value="" placeholder="">
                <input type="hidden" name="scaleY" value="" placeholder="">

                <button type="submit" class="btn btn-success">{{ trans('form.button.save') }}</button>
                <button type="reset" class="btn btn-default pull-right">{{ trans('form.button.cancel') }}</button>
            </form>
        </div>
    </div>
</div>


