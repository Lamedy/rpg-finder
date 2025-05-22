@extends('layouts.MainContentPage')

@section('page_name', 'Регистрация')

@section('content_title', 'Подтверждение email:')

@section('content')
    <form method="POST" action="{{ route('registration.confirm.submit') }}">
        @csrf

        <div class="max-w-md mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-white p-6 space-y-4">
                <div>
                    <label for="code" class="block font-bold text-lg text-gray-800 mb-1">Код подтверждения:</label>
                    <input type="text" id="code" name="code" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <!-- Нижняя тёмная часть с кнопкой -->
            <div class="bg-[#2D2D2D] p-4 flex justify-center space-x-4">
                <a href="{{route('registration')}}"
                   class="bg-white text-center font-bold px-5 py-2 rounded hover:bg-[#828282] transition w-60">
                    Назад
                </a>
                <button type="submit"
                        class="bg-white text-center font-bold px-5 py-2 rounded hover:bg-[#828282] transition w-60">
                    Подтвердить
                </button>
            </div>
        </div>
    </form>
@endsection
