@extends('layouts.MainContentPage')

@section('page_name', 'Мои анкеты')

@section('content_title')
    <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center sm:flex-wrap">
        <div class="text-xl md:text-2xl w-full sm:w-auto text-center sm:text-left">Мои анкеты</div>
        <a href="{{ route('create.card') }}"
           class="w-full sm:w-auto p-1 text-center no-shadow text-black bg-gray-200 px-2 font-alegreya_bold rounded hover:bg-[#ababab] text-base md:text-2xl">
            Создать анкету
        </a>
    </div>
@endsection

@section('content')
    @include('Components.CardList')
    <!-- Пагинация -->
    {{ $games->links('pagination::tailwind') }}
@endsection

