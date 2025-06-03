@extends('layouts.MainContentPage')

@section('page_name', 'Главная')

@section('content_title', 'Новости сайта:')

@section('content')
                    <!-- Список новостей -->
                    @foreach ($newsList as $news)
                        <div class="bg-gray-200 mb-4 rounded shadow border border-black font-alegreya_medium">
                            <p class="mb-2 p-2 break-words">{{ $news['news_text'] }}</p>
                            <div class="bg-[#3A3A3A] text-white text-sm px-2 py-1 rounded border">
                                {{ \Carbon\Carbon::parse($news['date'])->format('Дата: d.m.Y Время: H:i') }}
                            </div>
                        </div>
                    @endforeach
@endsection
