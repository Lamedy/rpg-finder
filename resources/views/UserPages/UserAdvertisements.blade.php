@extends('layouts.MainContentPage')

@section('page_name', 'Мои анкеты')

@section('content_title')
    <div class="flex justify-between items-center">
        <div>Мои анкеты</div>
        <a href="{{ route('create.card') }}"
           class="text-black no-shadow bg-gray-200 font-bold px-2 rounded hover:bg-[#828282]">
            Создать анкету
        </a>
    </div>
@endsection

@section('content')
    @include('Components.CardList')
    <!-- Пагинация -->
    {{ $games->links('pagination::tailwind') }}
@endsection

