@extends('layout.errors')

@section('title') 404 @endsection

@section('content')

    <div class="row">
        <div class="col-sm-6">
            <div class="error-text">
                <h1>404</h1>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="error-text">
                <h3><span>Страница</span><br class="hidden-xs"> не найдена</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="error-desc text-center">
                <p>Запрашиваемая страница не найдена. Мы приносим свои извинения. Вы можете вернуться на главную страницу:</p>
                <a href="{{ route('home') }}" class="btn btn-success">Главная</a>
            </div>
        </div>
    </div>

@endsection
