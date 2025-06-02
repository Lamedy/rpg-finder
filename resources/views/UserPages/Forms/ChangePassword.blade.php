@extends('layouts.MainContentPage')

@section('page_name', 'Настройки')

@section('content_title', 'Изменить пароль:')

@section('content')
    <form id="password-form" method="POST" action="{{ route('account.settings.change_password.update') }}">
        @csrf
        <div class=" mx-auto rounded-md overflow-hidden shadow-lg border border-black bg-gray-200">
            <div class="p-4 space-y-4">
                    <div class="max-w-125 mx-auto">
                        <label for="current_password" class="block text-lg font-bold text-gray-800 mb-1">Старый пароль:</label>
                        <input type="password" name="current_password" id="current_password" required
                               class="mt-1 block w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]" />
                        @error('current_password')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="max-w-125 mx-auto">
                        <label for="new_password" class="block text-lg font-bold text-gray-800 mb-1">Новый пароль:</label>
                        <input type="password" name="new_password" id="new_password" required
                               class="mt-1 block w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]" />
                        @error('new_password')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="max-w-125 mx-auto">
                        <label for="new_password_confirmation" class="block text-lg font-bold text-gray-800 mb-1">Повторите новый пароль:</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                               class="mt-1 block w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]" />
                    </div>
                    @if (session('status'))
                        <div class="mb-4 p-3 rounded text-[#136e1f] font-semibold border">
                            {{ session('status') }}
                        </div>
                    @endif
            </div>
        <!-- Нижняя кнопка -->
        <div class="bg-[#2D2D2D] p-4 flex justify-center space-x-4">
            <a href="/account/settings"
                    class="bg-white text-black text-center font-bold px-5 py-2 rounded hover:bg-[#828282] transition w-60">
                Назад
            </a>
            <button type="submit" form="password-form"
                    class="bg-white text-black text-center font-bold px-5 py-2 rounded hover:bg-[#828282] transition w-60 cursor-pointer">
                Изменить пароль
            </button>
        </div>
    </div>
    </form>


@endsection

