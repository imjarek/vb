@extends('layout.app')

@section('header-icon')<i class="pe-7s-user"></i>@endsection

@section('header-title')
    <h1>{{ $headerTitle or trans('content.profile.title') }}</h1>
    <small>{{ trans('content.profile.description') }}</small>
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ trans('content.profile.title') }}</li>
@endsection

@section('css')
    <link href="{{ asset('libs/cropper/cropper.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{ asset('libs/cropper/cropper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('libs/ajaxUpload/ajax-upload.js') }}" type="text/javascript"></script>
    @parent
    <script src="{{ asset('js/profile.js') }}" type="text/javascript"></script>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-lg-4">

                    @include('profile._form_logo')

                </div>

                <div class="col-xs-12 col-md-7 col-lg-8">

                    @include('profile._form_user')

                    @include('profile._form_password')

                </div>
            </div>
        </div>
    </div>

@endsection