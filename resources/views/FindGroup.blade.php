@extends('layouts.MainContentPage')

@section('page_name', 'Поиск компании')

@section('content_title')
    <div class="flex justify-between items-center">
        <div>Поиск компании</div>
        <a href="{{ route('create.card') }}"
           class="no-shadow text-black bg-gray-200 font-bold px-2 rounded hover:bg-[#ababab]">
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

