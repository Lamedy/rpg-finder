@extends('layouts.MainContentPage')

@section('page_name', 'Регистрация')

@section('content_title', 'Форма регистрации:')

@section('content')
    <form action="{{ route('registration.submit') }}" method="POST">
        @csrf

        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black">
            <!-- Верхняя светлая часть -->
            <div class="bg-gray-200 p-6 space-y-4">
                <div class="max-w-125 mx-auto">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="login" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Логин*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block font-alegreya_bold" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                class="absolute top-full mt-2 w-auto min-w-55 sm:min-w-60 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Логин аккаунта используется как уникальный идентификатор.
                            </div>
                        </div>
                    </div>
                    <input type="text" id="login" name="login" required
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           value="{{ old('login') }}"
                    >
                    @error('login')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="max-w-125 mx-auto">

                    <div class="mb-1 flex items-center gap-2">
                        <label for="name" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Имя:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block font-alegreya_bold" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-60 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Имя аккаунта будет отображаться другим пользователям, если оставить поле пустым,
                                то в качестве имени будет использоваться ваш логин.
                            </div>
                        </div>
                    </div>
                    <input type="text" id="name" name="name"
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           value="{{ old('name') }}"
                    >
                    @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="max-w-125 mx-auto">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="password" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Пароль*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block font-alegreya_bold" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                class="absolute top-full mt-2 w-auto min-w-30 sm:min-w-60 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Пароль должен быть длинной минимум 6 символов.
                            </div>
                        </div>
                    </div>
                    <input type="password" id="password" name="password" required
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                    @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="max-w-125 mx-auto">
                    <label for="password_confirmation" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Повторите пароль*:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                </div>

                <div class="max-w-125 mx-auto">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="email" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Email*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block font-alegreya_bold" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Почта используется чтобы присылать вам уведомления от других пользователей,
                                а также чтобы вы могли восстановить доступ к своему аккаунту. <br>
                                Максимальная длина почты - 255 символов.
                            </div>
                        </div>
                    </div>
                    <input type="email" id="email" name="email" required
                           class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           value="{{ old('email') }}"
                    >
                    @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-125 w-full mx-auto">
                    <div>
                        <label for="gender" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Пол:</label>
                        <select id="gender" name="gender"
                                class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                            <option value="" {{ old('gender') === '' ? 'selected' : '' }}></option>
                            <option value="0" {{ old('gender') === '0' ? 'selected' : '' }}>Женский</option>
                            <option value="1" {{ old('gender') === '1' ? 'selected' : '' }}>Мужской</option>
                        </select>
                    </div>

                    <div>
                        <label for="birthdate" class="block font-alegreya_bold text-lg text-gray-800 mb-1">Дата рождения:</label>
                        <input type="date" id="birthdate" name="birthdate"
                               min="1900-01-01"
                               max="{{ date('Y-m-d') }}"
                               class="font-alegreya_medium w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                               value="{{ old('birthdate') }}"
                        >
                        @error('birthdate')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- Нижняя тёмная часть с кнопкой -->
            <div class="bg-[#2D2D2D] p-4 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}"
                   class="bg-white text-center font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60">
                    Назад
                </a>
                <button type="submit"
                        class="bg-white text-center font-alegreya_bold px-5 py-2 rounded hover:bg-[#828282] transition w-full sm:w-60 cursor-pointer">
                    Зарегистрироваться
                </button>
            </div>
        </div>
    </form>

@endsection
