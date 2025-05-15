<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>НРИ-Файндер | @yield('page_name')</title>
    @vite('resources/css/app.css')
</head>
<body style="background-image: url('{{ asset('images/background.jpeg') }}');">
<header class="bg-[#2D2D2D] border-b-2 border-black box-shadow-lg">
        <div class="container max-w-7xl mx-auto py-2 flex items-center justify-between">
            <!-- Название сайта -->
            <div class="relative">
                <span class="text-white font-forum text-6xl block text-shadow">НРИ-Файндер | @yield('page_name')</span>
            </div>

            <!-- Авторизация -->
            <nav class="hidden md:flex space-x-6">
                <a href="/authorization" class="text-white text-4xl font-forum hover:text-gray-300 transition duration-200 text-shadow">Вход</a>
            </nav>
        </div>
    </header>

    @yield('main_content')
</body>
</html>
