@extends('layouts.MainContentPage')

@section('page_name', 'Поиск компании')

@section('content_title')
    <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center sm:flex-wrap">
        <!-- Левая часть: заголовок + кнопка -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
            <div class="text-xl md:text-2xl w-full sm:w-auto text-center sm:text-left">Поиск компании</div>

            <div class="lg:hidden flex w-full sm:w-auto">
                <button
                    @click="$store.ui.openFilters = true"
                    class="w-full sm:w-auto p-1 text-base md:text-2xl text-black bg-gray-200 hover:bg-[#ababab] rounded font-alegreya_bold"
                >
                    Фильтры поиска
                </button>
                @include('Components.MobileSearchFilters')
            </div>
        </div>

        <!-- Правая часть: кнопка "Создать анкету" -->
        <a href="{{ route('create.card') }}"
           class="w-full sm:w-auto p-1 lg:p-0 lg:px-2 text-center no-shadow text-black bg-gray-200 px-2 font-alegreya_bold rounded hover:bg-[#ababab] text-base md:text-2xl">
            Создать анкету
        </a>
    </div>

@endsection

@section('additional_menu')
    @include('Components.SearchFilters')
@endsection

@section('content')
    @include('Components.CardList')
    <!-- Пагинация -->
    {{ $games->links('pagination::tailwind') }}
@endsection

