@extends('layout.errors')

@section('title') 403 @endsection

@section('content')

    <div class="row">
        <div class="col-sm-6">
            <div class="error-text">
                <h1>403</h1>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="error-text">
                <h3><span>Доступ</span><br class="hidden-xs"> запрещен</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="error-desc text-center">
                <p>У Вас нет прав на просмотр данного раздела. Вы можете вернуться на главную страницу:</p>
                <a href="{{ route('home') }}" class="btn btn-success">Главная</a>
            </div>
        </div>
    </div>

@endsection