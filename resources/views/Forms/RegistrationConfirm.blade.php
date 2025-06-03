@extends('layouts.MainContentPage')

@section('page_name', 'Регистрация')

@section('content_title', 'Подтверждение email:')

@section('content')
    <form method="POST" action="{{ route('registration.confirm.submit') }}">
        @csrf

        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-white p-6 space-y-4">
                <div class="max-w-125 mx-auto">
                    <label for="code" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Код подтверждения:</label>
                    <input type="text" id="code" name="code" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                </div>
            </div>

            <!-- Нижняя тёмная часть с кнопкой -->
            <div class="bg-[#2D2D2D] p-4 flex flex-col sm:flex-row justify-center sm:space-x-4 space-y-4 sm:space-y-0">
                <a href="{{route('registration')}}"
                   class="bg-white text-center font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60">
                    Назад
                </a>
                <button type="submit"
                        class="bg-white text-center font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60">
                    Подтвердить
                </button>
            </div>

        </div>
    </form>
@endsection
