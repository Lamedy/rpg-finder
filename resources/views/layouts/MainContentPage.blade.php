@extends('layouts.PageHead')

@section('main_content')
    <div class="md:p-4 lg:px-20">
        <div x-cloak class="mx-auto rounded-md flex">
            <!-- Левая колонка: Навигация + доп меню -->
            <aside
                   x-cloak
                   class="w-73 min-w-73 text-white self-start lg:static lg:block hidden">
                <!-- Навигация -->
                <div class="bg-[#2D2D2D] p-4 font-alegreya_medium">
                    <h2 class="text-shadow text-2xl mt-2 mb-4 border-b border-white pb-2">Навигация:</h2>
                    <ul class="space-y-2 text-xl">
                        <li><a href="/" class="block px-3 py-2 rounded hover:bg-[#1a1a1a]">Главная</a></li>
                        <li><a href="/findGroup" class="block px-3 py-2 rounded hover:bg-[#1a1a1a]">Поиск компании</a></li>
                    </ul>
                </div>
                <br>
                <!-- Дополнительное меню -->
                @yield('additional_menu')
            </aside>
            <!-- Правая колонка: Контент -->
            <main class="min-w-full p-1 sm:p-1 md:p-2 lg:p-4 ml-0 lg:max-w-4/6 lg:min-w-4/6 lg:ml-4 bg-[#3A3A3A]">
                <h2 class="text-shadow mt-2 text-white text-2xl font-alegreya_medium mb-4 border-b border-white pb-2">
                    @yield('content_title')
                </h2>
                @yield('content')
            </main>
        </div>
    </div>
@endsection
