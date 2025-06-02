@forelse ($games as $game)
    <div
        class=" mx-auto bg-gray-200 rounded-lg border border-gray-400 px-4 shadow-md font-serif text-xl leading-tight font-alegreya_medium">
        <div class="flex justify-between items-start py-4">
            <div class="text-2xl space-y-1 max-w-[60%]">
                @if ($game->city != null)
                    <div>
                        <span class="font-alegreya_bold">Город:</span>
                        <span class="text-xl">{{ $game->city->city }}</span>
                    </div>
                @endif
                <div>
                    <span class="font-alegreya_bold">
                        @if (count($game['gameSystems']) > 1)
                            Системы:
                        @else
                            Система:
                        @endif
                    </span>
                    <span class="text-xl">
                            {{ $game['gameSystems']->map(fn($s) => $s->system->game_system_name)->implode(', ') }}
                        </span>
                </div>
                <div>
                    <span class="font-alegreya_bold">Формат игры:</span>
                    <span class="text-xl"> {{ $game['game_format']->label() }} </span>
                </div>
                <div>
                    <span class="font-alegreya_bold">Длительность игры:</span>
                    <span class="text-xl"> {{ $game['game_duration']->label() }} </span>
                </div>
                <div>
                    <span class="font-alegreya_bold">Требуется:</span>
                    <span class="text-xl"> {{ $game['player_type_needed']->label() }} </span>
                </div>
            </div>

            <div class=" max-w-[38%]">
                <!-- Информация о пользователе -->
                <a href="{{ route('profile', $game['user']) }}">
                    <div class="flex items-center space-x-3 justify-end">
                        <!-- Аватар -->
                        <img
                            src="{{ asset('storage/' . $game['user']->avatar) }}"
                            alt="Аватар"
                            class="w-25 h-25 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                        />

                        <!-- Имя и рейтинг -->
                        <div class="text-center font-alegreya_medium text-4xl px-2">
                            <div>
                                {{ $game['user']->user_name }}
                            </div>
    {{--                        todo Вернуть когда будет реализованна система отзывов--}}
    {{--                        <div class="text-yellow-400">--}}
    {{--                            @for ($i = 1; $i <= 5; $i++)--}}
    {{--                                @if ($i <= $game['user']->rating)--}}
    {{--                                    ★--}}
    {{--                                @else--}}
    {{--                                    ☆--}}
    {{--                                @endif--}}
    {{--                            @endfor--}}
    {{--                        </div>--}}
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="border-t border-black py-2 ">
            <span class="text-xl font-alegreya_bold">Теги:</span>
            <span>
                @if ($game['tags'] && $game['tags']->count() > 0)
                    {{ $game['tags']->map(fn($s) => $s->tag->game_style_tag)->implode(', ') }}
                @else
                    Отсутствуют
                @endif
            </span>
        </div>

        <div class="border-t border-gray-500 text-xl py-2">
            <span class="font-alegreya_bold">Описание:</span> <br>
            <span> {{ $game->game_description }} </span>
        </div>

        <div>
            @if ($game->user->show_contacts_others)
                <span class="text-xl py-1 font-alegreya_bold">Контакты:</span> <br>
                <span> {{ $game->contacts }} </span>
            @endif
        </div>
        <div class="text-xl  py-2">
            @if ( $game['game_place'] != null )
                <div class="font-alegreya_bold">Место проведения игры: <span class="text-black">{{ $game['game_place'] }}</span></div>
            @endif
            <div class="flex justify-between items-center">
                @if( $game->game_date != null)
                    <span class="mr-2 font-alegreya_bold">
                                Дата: {{ \Carbon\Carbon::parse($game->game_date)->format('d.m.Y') }}
                        @if (\Carbon\Carbon::parse($game->game_date)->format('H:i') != '00:00')
                            Время: {{ \Carbon\Carbon::parse($game->game_date)->format('H:i') }}
                        @endif
                            </span>
                @endif
            </div>
        </div>
        <div class="flex justify-between items-center text-xl ">
            <div>
                <div class="font-alegreya_bold">Нужно игроков: <span class="text-black">{{ $game['player_count'] }}</span></div>
                <div class="font-alegreya_bold">Цена:
                    <span class="text-black">
                            @if ($game['price'] > 0 )
                            {{ $game['price'] }} Рублей.
                        @else
                            Бесплатно
                        @endif
                        </span>
                </div>
            </div>
            <div class="space-x-2 flex">
                @if (Auth::user() != null && Auth::user()->user_pk == $game->author)
                    <form action="{{ route('card.delete', $game->game_session_pk) }}" method="POST" onsubmit="return confirm('Удалить эту сессию?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                           class="ml-auto bg-[#2D2D2D] hover:bg-gray-300 text-lg text-white text-center rounded px-4 py-2 transition w-60">
                            Удалить
                        </button>
                    </form>

                    <a href="{{ route('card.edit', $game) }}"
                        class="ml-auto bg-[#2D2D2D] hover:bg-gray-300 text-lg text-white text-center rounded px-4 py-2 transition w-60">
                        Редактировать
                    </a>
                @else
                    <button
                        class="ml-auto bg-[#2D2D2D] hover:bg-gray-300 text-lg text-white rounded px-4 py-2 transition w-60">
                        Откликнуться
                    </button>
               @endif
            </div>
        </div>
        <div class="text-xl  text-right text-[#808080] px-1 py-1">
                        <span>
                            Объявление создано: {{ \Carbon\Carbon::parse($game['created_at'])->format('Дата: d.m.Y Время: H.i') }}
                        </span>
        </div>
    </div>
    <br>
@empty
    <div class="bg-gray-200 text-4xl py-4 font-alegreya_bold text-center rounded-lg border border-gray-400 shadow-md">
        Похоже, объявлений не найдено :(
    </div>
@endforelse
