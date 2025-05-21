@extends('layouts.MainContentPage')

@section('page_name', 'Поиск компании')

@section('content_title')
    <div class="flex justify-between items-center">
        <div>Поиск компании</div>
        <a href="{{ route('create.card') }}"
           class="text-black bg-gray-200 font-bold px-2 rounded hover:bg-[#828282]">
            Создать анкету
        </a>
    </div>
@endsection

@section('additional_menu')
    <div class="bg-[#2D2D2D] p-4">
        <h2 class="text-2xl font-alegreya_medium mb-4 border-b border-white pb-2">Фильтры поиска:</h2>
        Дальше тут будут фильтры todo
    </div>

@endsection

@section('content')
    <div class=" mx-auto bg-gray-200 rounded-lg border border-gray-400 p-4 shadow-md font-serif text-sm leading-tight">
        <div class="flex justify-between items-start mb-2">
            <div class="text-xs font-bold space-y-1 max-w-[60%]">
                <div><span class="font-semibold">Система:</span> DnD 5e</div>
                <div><span class="font-semibold">Формат игры:</span> В живую</div>
                <div><span class="font-semibold">Длительность игры:</span> Кампания</div>
                <div><span class="font-semibold">Требуется:</span> Игроки</div>
            </div>
            <div class="text-xs font-bold space-y-1 text-right max-w-[38%]">
                <div><span class="font-semibold">Тюленчик</span>
                    <span class="inline-block align-middle ml-2 text-yellow-400">
                    ★☆☆☆☆
                </span>
                </div>
                <div>Опыт игры: меньше года</div>
            </div>
        </div>

        <div class="border-t border-gray-500 pt-2 text-xs font-bold">
            Тэги: тяжелый моральный выбор, гибель персонажа, политика, интриги.
        </div>

        <div class="border-t border-gray-500 pt-2 text-xs whitespace-pre-line" style="min-height: 6rem;">
            <span class="font-bold">Описание:</span>
            Начинающий мастер ищу игроков(водил около 5-6 ваншотов) хочу провести полноценную собственно сделанную кампанию, в сеттинге фэнтези по ДнД 2014-2024 5e.
        </div>

        <div class="flex justify-between items-center mt-4 text-xs font-bold">
            <div>
                <div>Осталось мест: <span class="text-black">4</span></div>
                <div>Цена: <span class="text-black">Бесплатно</span></div>
            </div>
            <div class="space-x-2">
                <button class="bg-gray-700 hover:bg-gray-600 text-white rounded px-4 py-1">Подробнее</button>
                <button class="bg-gray-700 hover:bg-gray-600 text-white rounded px-4 py-1">Откликнуться</button>
            </div>
        </div>
    </div>
    <!-- Тут начало карточки 2 -->
    <br>
    <div class=" mx-auto bg-gray-200 rounded-lg border border-gray-400 p-4 shadow-md font-serif text-sm leading-tight">
        <div class="flex justify-between items-start mb-2">
            <div class="text-xs font-bold space-y-1 max-w-[60%]">
                <div><span class="font-semibold">Система:</span> DnD 5e</div>
                <div><span class="font-semibold">Формат игры:</span> В живую</div>
                <div><span class="font-semibold">Длительность игры:</span> Кампания</div>
                <div><span class="font-semibold">Требуется:</span> Игроки</div>
            </div>
            <div class="text-xs font-bold space-y-1 text-right max-w-[38%]">
                <div><span class="font-semibold">Тюленчик</span>
                    <span class="inline-block align-middle ml-2 text-yellow-400">
                    ★☆☆☆☆
                </span>
                </div>
                <div>Опыт игры: меньше года</div>
            </div>
        </div>

        <div class="border-t border-gray-500 pt-2 text-xs font-bold">
            Тэги: тяжелый моральный выбор, гибель персонажа, политика, интриги.
        </div>

        <div class="border-t border-gray-500 pt-2 text-xs whitespace-pre-line" style="min-height: 6rem;">
            <span class="font-bold">Описание:</span>
            Начинающий мастер ищу игроков(водил около 5-6 ваншотов) хочу провести полноценную собственно сделанную кампанию, в сеттинге фэнтези по ДнД 2014-2024 5e.
        </div>
        <div class="flex justify-between items-center mt-4 text-xs font-bold">
            <div>
                <div>Осталось мест: <span class="text-black">4</span></div>
                <div>Цена: <span class="text-black">Бесплатно</span></div>
            </div>
            <div class="space-x-2">
                <button class="bg-gray-700 hover:bg-gray-600 text-white rounded px-4 py-1">Подробнее</button>
                <button class="bg-gray-700 hover:bg-gray-600 text-white rounded px-4 py-1">Откликнуться</button>
            </div>
        </div>
    </div>
@endsection


