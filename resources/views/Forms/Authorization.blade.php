@extends('layouts.PageHead')

@section('page_name', 'Авторизация')

@section('content')
    <div>
        <div>
            Логин:
            <input>
        </div>
        <div>
            Пароль:
            <input>
        </div>
        <button>Войти</button>
    </div>
    <div>
        <a href="{{ route('registration') }}" class="btn btn-primary">Зарегестрироваться</a>
    </div>
    <div>
        <button>Не помню свой пароль</button>
    </div>
@endsection
