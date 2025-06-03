@extends('layouts.MainContentPage')

@section('page_name', 'Авторизация')

@section('content_title', 'Форма авторизации')

@section('content')
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-gray-200 p-4 space-y-4 ">
                <div class="max-w-125 mx-auto">
                    <label for="login" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Логин:</label>
                    <input type="text" id="login" name="login" required
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                    @error('login')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="max-w-125 mx-auto">
                    <label for="password" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Пароль:</label>
                    <input type="password" id="password" name="password" required
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                    @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-right text-sm font-alegreya_medium text-[#4f4f4f] underline hover:text-black cursor-pointer max-w-125 mx-auto">
                    Не помню свой пароль
                </div>
            </div>

            <!-- Нижняя тёмная часть с кнопками -->
            <div class="bg-[#2D2D2D] p-4 flex flex-col sm:flex-row justify-center gap-4">
                <a href="/registration"
                   class="block text-center bg-white font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60">
                    Зарегистрироваться
                </a>
                <button
                    class="bg-white font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60 cursor-pointer">
                    Войти
                </button>
            </div>

        </div>
    </form>
@endsection
