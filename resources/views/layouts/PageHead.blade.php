<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>НРИ-Файндер | @yield('page_name')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data="{ open: false }" :class="{ 'overflow-hidden': open }" style="background-image: url('{{ asset('images/background.jpeg') }}') ;">
<header class="relative bg-[#2D2D2D] border-b-2 border-black box-shadow-lg">
        <div class=" mx-auto p-2 px-4 flex items-center justify-between">
            <!-- Название сайта -->
            <div class="relative">
                <span class="text-white font-forum text-6xl block text-shadow">
                    НРИ-Файндер |
                    <span class="text-4xl align-middle">@yield('page_name')</span>
                </span>
            </div>

            <!-- Авторизация -->
            <nav class="absolute top-2 right-2 flex space-x-6">
                @if (Auth::check())
                    <div >
                        <!-- Аватар-кнопка для открытия меню -->
                        <img
                            src="{{ asset('storage/' . Auth::user()->avatar) }}"
                            alt="Аватар"
                            class="w-15 h-15 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                            @click="open = true"
                        />

                        <!-- Меню, выезжающее справа -->
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-in-out duration-300"
                            x-transition:enter-start="translate-x-full"
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition ease-in-out duration-300"
                            x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="translate-x-full"
                            class="fixed top-0 right-0 h-full w-1/5 bg-[#262626] shadow-lg z-50 flex flex-col"
                            @click.away="open = false"
                            style="display: none"
                        >

                            <div class="flex p-2 items-center justify-start space-x-4">

                                <img
                                    src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                    alt="Аватар"
                                    class="w-15 h-15 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                                />
                                <a class="text-white font-forum text-3xl p-2 text-shadow text-left">
                                    {{ Auth::user()->user_name }}
                                </a>
                                <button @click="open = false" class="ml-auto p-4 text-xl font-bold text-white hover:text-red-600 transition-colors duration-200">&times;</button>
                            </div>
                            <div class="w-full px-2">
                                <div class="border-b border-white"></div>
                            </div>
                        <!-- Список действий -->
                        <nav class="flex flex-col space-y-4 px-6 py-2">
                            <a href="" class="text-lg text-white hover:text-blue-600">Уведомления</a>
                            <a href="{{ route('account.my_advertisements') }}" class="text-lg text-white hover:text-blue-600">Мои анкеты</a>
                            <a href="" class="text-lg text-white hover:text-blue-600">Профиль</a>
                            <a href="/account/settings" class="text-lg text-white hover:text-blue-600">Настройки</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-lg text-white hover:text-red-600">Выйти из аккаунта</button>
                            </form>
                        </nav>
                        </div>
                    </div>
                @else
                <a href="/login" class="text-white text-4xl p-3 font-forum hover:text-gray-300 transition duration-200 text-shadow">Вход</a>
                @endif
            </nav>
        </div>
    </header>

    @yield('main_content')

    @yield('scripts')
</body>
</html>
