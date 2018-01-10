@extends('layout.errors')

@section('title') 503 @endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="error-text">
                <h1>503</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="error-desc">
                <p>Сервер столкнулся с чем-то неожиданным, что не позволило ему выполнить запрос. Мы приносим свои извинения. Вы можете вернуться на главную страницу:</p>
                <a href="{{ route('home') }}" class="btn btn-success">Главная</a>
            </div>
        </div>
    </div>

@endsection