<!DOCTYPE html>

<html lang="ru">
<head>
    <link rel="stylesheet" href="{{ asset('css/head_page.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>НРИ-Файндер | @yield('page_name')</title>
</head>
<body style="background-image: url('{{ asset('images/background.jpeg') }}');">
    <header>
            <h1>НРИ-Файндер | @yield('page_name')</h1>
        <a href="/authorization">Вход</a>
    </header>

    <h2>Навигация:</h2>
    <div>
        <a href="/">Главная</a>
    </div>
    <div>
        <a href="/findGroup">Поиск компании</a>
    </div>

    <div class="container">
        <H2>Основной контент страницы:</H2>
        @yield('content')
    </div>
</body>
</html>
