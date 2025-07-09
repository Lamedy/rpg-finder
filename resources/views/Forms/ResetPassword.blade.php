@extends('layouts.MainContentPage')

@section('page_name', 'Авторизация')

@section('content_title', 'Форма авторизации')

@section('content')
    <form action="{{ route('password.reset.update') }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="token" value="{{ request()->token }}">
        <input type="hidden" name="email" value="{{ request()->email }}">

        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-gray-200 p-4 space-y-4 ">
                <div class="max-w-125 mx-auto">
                    <label for="password" class="block font-alegreya_bold text-lg text-black mb-1">Новый пароль:</label>
                    <input type="password" id="password" name="password" required minlength="6"
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                    @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="max-w-125 mx-auto">
                    <label for="password_confirmation" class="block font-alegreya_bold text-lg text-black mb-1">Повторите новый пароль:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                </div>
            </div>

            <!-- Нижняя тёмная часть с кнопками -->
            <div class="bg-[#2D2D2D] p-4 flex flex-col sm:flex-row justify-center gap-4">
                <button
                    class="bg-white font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60 cursor-pointer">
                    Сбросить пароль
                </button>
            </div>

        </div>
    </form>
@endsection
