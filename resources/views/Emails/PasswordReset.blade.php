@php use Illuminate\Support\Str; @endphp

<div class="p-6 bg-white shadow rounded-xl text-gray-800 font-[forum]">
    <h1 class="text-2xl mb-4">Сброс пароля</h1>
    <p class="mb-4">Вы получили это письмо, потому что запросили сброс пароля.</p>

    <a href="{{ $url }}"
       class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-900 transition">
        Сбросить пароль
    </a>

    <p class="mt-4 text-sm text-gray-500">Если вы не запрашивали — просто проигнорируйте письмо.</p>
</div>
