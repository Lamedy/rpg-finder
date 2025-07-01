<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>НРИ-Файндер | @yield('page_name')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/icons/rpg-finder-icon.png') }}" type="image/png">
</head>
<body x-data="{ open: false }"
      :class="{ 'overflow-hidden': $store.ui.anyPanelOpen }"
      style="
          background-image: url('{{ asset('images/background.jpeg') }}');
          background-attachment: fixed;
          background-size: cover;
          background-position: center top;
          background-repeat: no-repeat;
      ">

<header class="relative bg-[#2D2D2D] border-b-2 border-black box-shadow-lg">
        <div class="mx-auto p-2 px-4 flex items-center justify-between">
            <!-- Название сайта -->
            <div class="relative">
                <a href="{{ route('main') }}" class="text-white font-forum text-2xl sm:text-2xl md:text-2xl lg:text-6xl block text-shadow">
                    НРИ-Файндер
                    <span class="hidden sm:inline">
                        | <span class="text-2xl sm:text-2xl md:text-2xl lg:text-4xl align-middle">@yield('page_name')</span>
                    </span>
                </a>
            </div>
            <div class="flex items-center gap-4 lg:hidden">
                @if(Auth::check())
                    <!-- Иконка уведомлений -->
                    <a href="{{ route('account.notifications') }}" class="group relative inline-block bg-gray-300 mr-8 hover:bg-[#1a1a1a] rounded p-1 rounded-xl">
                        <!-- Колокольчик -->
                        <svg class="w-6 h-6 text-black group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>

                        <!-- Счётчик -->
                        @if(Auth::check() && $unreadNoticesCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                {{ $unreadNoticesCount }}
                            </span>
                        @endif
                    </a>
                @endif
                <button @click="$store.ui.openMenu = !$store.ui.openMenu" class="absolute top-2 right-2 flex text-3xl text-white text-shadow">☰</button>
            </div>
            <!-- Авторизация -->
            <nav class="absolute top-2 right-2 flex space-x-6 lg:static lg:block hidden">
            @if (Auth::check())
                    <div class="flex items-center gap-4">
                        <!-- Иконка уведомлений -->
                        <a href="{{ route('account.notifications') }}" class="group relative inline-block bg-gray-300 hover:bg-[#1a1a1a] rounded p-1 rounded-xl">
                            <!-- Колокольчик -->
                            <svg class="w-6 h-6 text-black group-hover:text-white" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>

                            <!-- Счётчик -->
                            @if($unreadNoticesCount > 0)
                                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                    {{ $unreadNoticesCount }}
                                </span>
                            @endif
                        </a>
                        <!-- Аватар-кнопка для открытия меню -->
                        <img
                            src="{{ asset('storage/' . Auth::user()->avatar) }}"
                            alt="Аватар"
                            class="w-15 h-15 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                            onerror="this.onerror=null;this.src='{{ asset('storage/avatars/default_avatar.png') }}';"
                            @click="$store.ui.openMenu = true"
                        />

                        <!-- Меню, выезжающее справа -->
                        <div
                            x-show="$store.ui.openMenu"
                            x-transition:enter="transition ease-in-out duration-300"
                            x-transition:enter-start="translate-x-full"
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition ease-in-out duration-300"
                            x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="translate-x-full"
                            class="fixed top-0 right-0 h-full w-1/5 min-w-80 bg-[#262626] shadow-lg z-50 flex flex-col"
                            @click.away="$store.ui.openMenu = false"
                            style="display: none"
                        >

                            <div class="flex p-2 items-center justify-start space-x-4">

                                <img
                                    src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                    alt="Аватар"
                                    class="w-15 h-15 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                                    onerror="this.onerror=null;this.src='{{ asset('storage/avatars/default_avatar.png') }}';"
                                />
                                <a class="text-white font-alegreya_medium text-3xl p-2 text-shadow text-left truncate">
                                    {{ Auth::user()->user_name }}
                                </a>
                                <button @click="$store.ui.openMenu = false" class="ml-auto p-4 text-xl font-bold text-white hover:text-red-600 transition-colors duration-200">&times;</button>
                            </div>
                            <div class="w-full px-2">
                                <div class="border-b border-white"></div>
                            </div>
                        <!-- Список действий -->
                        <nav class="flex flex-col space-y-1 px-2 py-1 font-alegreya_medium">
                            <a href="{{ route('account.notifications') }}"
                               class="group relative flex items-center gap-2 p-2 rounded text-lg text-white hover:bg-[#1a1a1a]">
                                <span>Уведомления</span>

                                <!-- Иконка колокольчика -->
                                <div class="relative">
                                    <svg class="w-6 h-6 text-white transition-colors duration-200"
                                         fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>

                                    @if($unreadNoticesCount > 0)
                                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                            {{ $unreadNoticesCount }}
                                        </span>
                                    @endif
                                </div>
                            </a>

                            <a href="{{ route('account.my_advertisements') }}" class="p-2 rounded text-lg text-white hover:bg-[#1a1a1a]">Мои анкеты</a>
                            <a href="{{ route('profile', Auth::user()) }}" class="p-2 rounded text-lg text-white hover:bg-[#1a1a1a]">Профиль</a>
                            <a href="/account/settings" class="p-2 rounded text-lg text-white hover:bg-[#1a1a1a]">Настройки</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left p-2 rounded text-lg text-white hover:bg-[#1a1a1a] cursor-pointer">Выйти из аккаунта</button>
                            </form>
                        </nav>
                        </div>
                    </div>
                @else
                <a href="/login" class="text-white sm:text-lg md:text-lg lg:text-4xl p-3 font-forum hover:text-gray-300 transition duration-200 text-shadow">
                    Вход
                </a>
                @endif
            </nav>
            @include('layouts.MobileBurgerNavigationMenu')
        </div>
    </header>

    @yield('main_content')

    @yield('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('ui', {
                openFilters: false,
                openMenu: false,
                get anyPanelOpen() {
                    return this.openFilters || this.openMenu;
                }
            });
        });
    </script>
</body>
</html>
