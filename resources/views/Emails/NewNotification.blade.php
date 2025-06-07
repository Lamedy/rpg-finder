<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новое сообщение — НРИ Файндер</title>
</head>
<body class="bg-gray-100 py-8">
<table class="w-full max-w-xl mx-auto bg-white border border-gray-200 rounded shadow-sm p-6" role="presentation">
    <tr>
        <td class="px-6 py-4 text-center bg-[#1a1a1a] text-white text-2xl font-bold rounded-t">
            НРИ Файндер
        </td>
    </tr>

    <tr>
        <td class="px-6 py-4">
            <p class="text-lg text-gray-800 font-semibold mb-4">Привет, {{ $user->user_name }}!</p>

            <p class="text-gray-700 mb-4">
                У вас новое сообщение от пользователя <strong>{{ $sender->user_name }}</strong> на платформе <strong>НРИ-Файндер</strong>.
            </p>

            <p class="text-gray-700 mb-6">
                Чтобы прочитать сообщение, перейдите по кнопке ниже:
            </p>

            <div class="text-center mb-6">
                <a href="{{ $link }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-2 px-4 rounded">
                    Читать сообщение
                </a>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
