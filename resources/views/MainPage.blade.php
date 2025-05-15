@extends('layouts.MainContentPage')

@section('page_name', 'Главная')

@section('content_title', 'Новости сайта:')

@section('content')
                    <!-- Список новостей -->
                    @foreach ($newsList as $news)
                        <div class="bg-white mb-4 rounded shadow border border-black">
                            <p class="mb-2 p-2 font-semibold">{{ $news['news_text'] }}</p>
                            <div class="bg-[#3A3A3A] text-white text-sm px-2 py-1 rounded border">
                                Дата: <strong>{{ substr($news['date'], 0, 10) }}</strong>
                            </div>
                        </div>
                    @endforeach
@endsection
