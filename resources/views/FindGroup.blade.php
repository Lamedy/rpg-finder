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
    @foreach($games as $game)
        <div class=" mx-auto bg-gray-200 rounded-lg border border-gray-400 px-4 shadow-md font-serif text-sm leading-tight">
            <div class="flex justify-between items-start py-4">
                <div class="text-xs font-bold space-y-1 max-w-[60%]">
                    <div><span class="font-semibold">Город:</span> {{ $game->city->city }}</div>
                    <div>
                        <span class="font-semibold">Системы:</span>
                        {{ $game['gameSystems']->map(fn($s) => $s->system->game_system_name)->implode(', ') }}
                    </div>
                    <div><span class="font-semibold">Формат игры:</span> {{ $game['game_format']->label() }}</div>
                    <div><span class="font-semibold">Длительность игры:</span> {{ $game['game_duration']->label() }}</div>
                    <div><span class="font-semibold">Требуется:</span> {{ $game['player_type_needed']->label() }}</div>
                </div>

                <div class="text-xs font-bold max-w-[38%]">
                    <!-- Информация о пользователе -->
                    <div class="flex items-center space-x-3 justify-end">
                        <!-- Аватар -->
                        <img
                            src="{{ asset('storage/' . $game['user']->avatar) }}"
                            alt="Аватар"
                            class="w-15 h-15 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                        />

                        <!-- Имя и рейтинг -->
                        <div class="text-center px-2">
                            <div class="font-semibold">{{ $game['user']->user_name }}</div>
                            <div class="text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $game['user']->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-500 py-2 text-xs font-bold">
                Тэги:
                @if ($game['tags'] != null)
                    {{ $game['tags']->map(fn($s) => $s->tag->game_style_tag)->implode(', ') }}
                @else
                    Отсутствуют
                @endif
            </div>

            <div class="border-t border-gray-500 text-xs whitespace-pre-line">
                <span class="font-bold">Описание:</span>
                {{ $game->game_description }}

                @if ($game->user->show_contacts_others)
                    <span class="font-bold">Контакты:</span>
                    {{ $game->contacts }}
                @endif
            </div>

            <div class="flex justify-between items-center mt-4 py-2 text-xs font-bold">
                <div>
                    @if ( $game['game_place'] != null )
                        <div>Место проведения игры: <span class="text-black">{{ $game['game_place'] }}</span></div>
                    @endif
                    <div class="flex justify-between items-center text-xs font-bold">
                        @if( $game->game_date != null)
                            <span class="mr-2">Дата: {{ \Carbon\Carbon::parse($game->game_date)->format('d.m.Y') }}</span>
                            <span>Время: {{ \Carbon\Carbon::parse($game->game_date)->format('H:i') }}</span>
                        @endif
                    </div>
                    <div>Нужно игроков: <span class="text-black">{{ $game['player_count'] }}</span></div>
                    <div>Цена:
                        <span class="text-black">
                            @if ($game['price'] > 0 )
                                {{ $game['price'] }} Рублей.
                            @else
                                Бесплатно
                            @endif
                        </span>
                    </div>
                </div>

                <div class="space-x-2">
                    <button class="bg-[#2D2D2D] hover:bg-gray-300 text-white rounded px-4 py-1 transition w-40">Подробнее</button>
                    <button class="bg-[#2D2D2D] hover:bg-gray-300 text-white rounded px-4 py-1 transition w-40">Откликнуться</button>
                    <div class="text-right text-gray-700 p-2">
                        <span>
                            Объявление создано: {{ \Carbon\Carbon::parse($game['created_at'])->format('Дата: d.m.Y Время: H.i') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endforeach

    <!-- Пагинация -->
    {{ $games->links('pagination::tailwind') }}
@endsection


