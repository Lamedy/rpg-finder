@forelse ($games as $game)
    <div
        class=" mx-auto bg-gray-200 rounded-lg border border-gray-400 px-4 shadow-md font-serif text-sm leading-tight">
        <div class="flex justify-between items-start py-4">
            <div class="text-base font-bold space-y-1 max-w-[60%]">
                @if ($game->city != null)
                    <div>
                        <span class="font-semibold">Город:</span>
                        <span class="text-sm">{{ $game->city->city }}</span>
                    </div>
                @endif
                <div>
                    <span class="font-semibold">Системы:</span>
                    <span class="text-sm">
                            {{ $game['gameSystems']->map(fn($s) => $s->system->game_system_name)->implode(', ') }}
                        </span>
                </div>
                <div>
                    <span class="font-semibold">Формат игры:</span>
                    <span class="text-sm"> {{ $game['game_format']->label() }} </span>
                </div>
                <div>
                    <span class="font-semibold">Длительность игры:</span>
                    <span class="text-sm"> {{ $game['game_duration']->label() }} </span>
                </div>
                <div>
                    <span class="font-semibold">Требуется:</span>
                    <span class="text-sm"> {{ $game['player_type_needed']->label() }} </span>
                </div>
            </div>

            <div class="text-base font-bold max-w-[38%]">
                <!-- Информация о пользователе -->
                <div class="flex items-center space-x-3 justify-end">
                    <!-- Аватар -->
                    <img
                        src="{{ asset('storage/' . $game['user']->avatar) }}"
                        alt="Аватар"
                        class="w-25 h-25 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                    />

                    <!-- Имя и рейтинг -->
                    <div class="text-center text-3xl px-2">
                        <div class="font-semibold">{{ $game['user']->user_name }}</div>
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
            </div>
        </div>

        <div class="border-t border-black py-2 font-bold">
            <span class="text-base font-bold">Тэги:</span>
            <span>
                    @if ($game['tags'] != null)
                    {{ $game['tags']->map(fn($s) => $s->tag->game_style_tag)->implode(', ') }}
                @else
                    Отсутствуют
                @endif
                </span>
        </div>

        <div class="border-t border-gray-500 text-base py-2">
            <span class="font-bold">Описание:</span> <br>
            <span> {{ $game->game_description }} </span>
        </div>

        <div>
            @if ($game->user->show_contacts_others)
                <span class="text-base py-1 font-bold">Контакты:</span> <br>
                <span> {{ $game->contacts }} </span>
            @endif
        </div>
        <div class="text-base font-bold py-2">
            @if ( $game['game_place'] != null )
                <div>Место проведения игры: <span class="text-black">{{ $game['game_place'] }}</span></div>
            @endif
            <div class="flex justify-between items-center">
                @if( $game->game_date != null)
                    <span class="mr-2">
                                Дата: {{ \Carbon\Carbon::parse($game->game_date)->format('d.m.Y') }}
                        @if (\Carbon\Carbon::parse($game->game_date)->format('H:i') != '00:00')
                            Время: {{ \Carbon\Carbon::parse($game->game_date)->format('H:i') }}
                        @endif
                            </span>
                @endif
            </div>
        </div>
        <div class="flex justify-between items-center text-base font-bold">
            <div>
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
            <div class="space-x-2 flex">
                <button
                    class="ml-auto bg-[#2D2D2D] hover:bg-gray-300 text-lg text-white rounded px-4 py-2 transition w-60">
                    Откликнуться
                </button>
            </div>
        </div>
        <div class="text-base font-bold text-right text-[#808080] px-1 py-1">
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
