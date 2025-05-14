@extends('layouts.page_head')

@section('page_name', 'Регистрация')

@section('content')
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('registration.confirm.submit') }}">
        @csrf
        <label for="code">Код подтверждения:</label>
        <input type="text" name="code" required>
        <button type="submit">Подтвердить</button>
    </form>
@endsection
