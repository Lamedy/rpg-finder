@extends('layouts.MainContentPage')

@section('page_name', 'Авторизация')

@section('content_title', 'Форма авторизации')

@section('content')
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="max-w-2xl mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-gray-200 p-6 space-y-4">
                <div>
                    <label for="login" class="block font-bold text-lg text-gray-800 mb-1">Логин:</label>
                    <input type="text" id="login" name="login" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('login')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block font-bold text-lg text-gray-800 mb-1">Пароль:</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-right text-sm font-semibold text-gray-700 underline hover:text-black cursor-pointer">
                    Не помню свой пароль
                </div>
            </div>

            <!-- Нижняя тёмная часть с кнопками -->
            <div class="bg-[#2D2D2D] p-4 flex justify-center space-x-4">
                <a href="/registration" class="block text-center bg-white font-bold px-5 py-2 rounded hover:bg-[#828282] transition w-60">
                    Зарегистрироваться
                </a>
                <button class="bg-white font-bold px-5 py-2 rounded hover:bg-[#828282] transition w-60">
                    Войти
                </button>
            </div>
        </div>
    </form>
@endsection
