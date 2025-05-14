@extends('layouts.PageHead')

@section('page_name', 'Регистрация')

@section('content')
    <form action="{{ route('registration.submit') }}" method="POST">
        @csrf
        <div>
            <label for="login">Логин*:</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div>
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="password">Пароль*:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="email">Email*:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="confirm_password">Повторите пароль*:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div>
            <label for="gender">Пол:</label>
            <select name="gender" id="gender">
                <option value=""></option>
                <option value="0">Мужской</option>
                <option value="1">Женский</option>
            </select>
            <label for="birthdate">Дата рождения:</label>
            <input type="date" id="birthdate" name="birthdate">
        </div>

        <button type="submit">Зарегистрироваться</button>
    </form>

@endsection
