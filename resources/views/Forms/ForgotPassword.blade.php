@extends('layouts.MainContentPage')

@section('page_name', 'Авторизация')

@section('content_title', 'Форма авторизации')

@section('content')
    <form action="{{ route('forgot_password.confirm') }}" method="POST">
        @csrf
        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-gray-200 p-4 space-y-4 ">
                <div class="max-w-125 mx-auto">
                    <label class="block font-alegreya_bold text-lg text-black mb-1 text-center">Введите почту на которую зарегистрирован аккаунт</label>
                    <label for="email" class="block font-alegreya_bold text-lg text-black mb-1">Email:</label>
                    <input type="email" id="email" name="email" required
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <label class="block font-alegreya_bold text-lg text-black mb-1 text-center"> {{ session('status') }}</label>
                </div>
            </div>

            <!-- Нижняя тёмная часть с кнопками -->
            <div class="bg-[#2D2D2D] p-4 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}"
                   class="block text-center bg-white font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60">
                    Назад
                </a>
                <button
                    class="bg-white font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60 cursor-pointer">
                    Сбросить пароль
                </button>
            </div>

        </div>
    </form>
@endsection
