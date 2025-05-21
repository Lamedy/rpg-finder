@extends('layouts.PageHead')

@section('main_content')
    <div class=" p-4 px-20">
        <div class=" mx-auto rounded-md flex">
            <!-- Левая колонка: Навигация + доп меню -->
            <aside class="w-1/6 text-white self-start">
                <!-- Навигация -->
                <div class="bg-[#2D2D2D] p-4">
                    <h2 class="text-2xl font-alegreya_medium mb-4 border-b border-white pb-2">Навигация:</h2>
                    <ul class="space-y-2">
                        <li><a href="/" class="block px-3 py-2 rounded hover:bg-[#1a1a1a]">Главная</a></li>
                        <li><a href="/findGroup" class="block px-3 py-2 rounded hover:bg-[#1a1a1a]">Поиск компании</a></li>
                    </ul>
                </div>
                <br>
                <!-- Дополнительное меню -->
                @yield('additional_menu')
            </aside>
            <!-- Правая колонка: Контент -->
            <main class="w-4/6 p-4 ml-4 bg-[#3A3A3A]" >
                <h2 class="text-white text-2xl font-alegreya_medium mb-4 border-b border-white pb-2">@yield('content_title')</h2>
                @yield('content')
            </main>
        </div>
    </div>
@endsection
