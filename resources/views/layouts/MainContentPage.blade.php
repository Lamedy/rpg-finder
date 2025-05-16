@extends('layouts.PageHead')

@section('main_content')
    <div class=" p-4">
        <div class="max-w-7xl mx-auto rounded-md flex">
            <!-- Левая колонка: Навигация -->
            <aside class="w-1/4 bg-[#2D2D2D] text-white p-4 self-start">
                <h2 class="text-2xl font-alegreya_medium mb-4 border-b border-white pb-2">Навигация:</h2>
                <ul class="space-y-2">
                    <li><a href="/" class="block px-3 py-2 bg-[#2D2D2D] rounded hover:bg-[#1a1a1a]">Главная</a></li>
                    <li><a href="/findGroup" class="block px-3 py-2 bg-[#2D2D2D] rounded hover:bg-[#1a1a1a]">Поиск компании</a></li>
                </ul>
            </aside>

            <!-- Правая колонка: Контент -->
            <main class="w-3/4 p-4 ml-4 bg-[#3A3A3A]" >
                <h2 class="text-white text-2xl font-alegreya_medium mb-4 border-b border-white pb-2">@yield('content_title')</h2>
                @yield('content')
            </main>
        </div>
    </div>
@endsection
