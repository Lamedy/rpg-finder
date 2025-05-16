@extends('layouts.MainContentPage')

@section('page_name', 'Регистрация')

@section('content_title', 'Форма регистрации:')

@section('content')
    <form action="{{ route('registration.submit') }}" method="POST">
        @csrf

        <div class="max-w-2xl mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-white p-6 space-y-4">
                <div>
                    <label for="login" class="block font-bold text-lg text-gray-800 mb-1">Логин*:</label>
                    <input type="text" id="login" name="login" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('login')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="name" class="block font-bold text-lg text-gray-800 mb-1">Имя:</label>
                    <input type="text" id="name" name="name"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block font-bold text-lg text-gray-800 mb-1">Пароль*:</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block font-bold text-lg text-gray-800 mb-1">Повторите пароль*:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="email" class="block font-bold text-lg text-gray-800 mb-1">Email*:</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="gender" class="block font-bold text-lg text-gray-800 mb-1">Пол:</label>
                        <select id="gender" name="gender"
                                class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value=""></option>
                            <option value="0">Мужской</option>
                            <option value="1">Женский</option>
                        </select>
                    </div>

                    <div>
                        <label for="birthdate" class="block font-bold text-lg text-gray-800 mb-1">Дата рождения:</label>
                        <input type="date" id="birthdate" name="birthdate"
                               class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('birthdate')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Нижняя тёмная часть с кнопкой -->
            <div class="bg-[#2D2D2D] p-4 flex justify-center">
                <button type="submit"
                        class="bg-white font-bold px-5 py-2 rounded hover:bg-[#828282] transition w-60">
                    Зарегистрироваться
                </button>
            </div>
        </div>
    </form>

@endsection
