@extends('layouts.page_head')

@section('page_name', 'Главная')

@section('content')
    <h1>Новости</h1>
    <ul>
        @foreach ($newsList as $news)
            <li><strong>{{ substr($news['date'], 0, 10) }}</strong>: {{ $news['news_text'] }}</li>
        @endforeach
    </ul>
@endsection
