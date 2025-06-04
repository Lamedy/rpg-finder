@forelse ($games as $game)
    <div
        class="mx-auto bg-gray-200 rounded-lg border border-gray-400 px-4 shadow-md font-serif text-xl leading-tight font-alegreya_medium">
        <div class="flex flex-wrap justify-center sm:justify-between items-start gap-4 mt-2">
            <!-- Левая часть: информация о пользователе -->
            <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start mt-4 gap-3 min-w-0 max-w-full 2xl:max-w-[48%]">
                <a href="{{ route('profile', $game['user']) }}" class="flex flex-col sm:flex-row items-center justify-center sm:justify-start gap-3 min-w-0 max-w-full w-full">
                    <!-- Аватар -->
                    <img
                        src="{{ asset('storage/' . $game['user']->avatar) }}"
                        alt="Аватар"
                        class="w-24 h-24 rounded-full object-cover border-2 border-black shadow-md cursor-pointer shrink-0"
                    />

                    <!-- Имя и рейтинг -->
                    <div class="text-center font-alegreya_medium text-4xl break-words sm:text-left w-full max-w-full truncate">
                        {{ $game['user']->user_name }}
                    </div>
                </a>
            </div>

            <div class="flex flex-col space-y-1 font-alegreya_bold text-xl lg:text-2xl w-full sm:w-auto sm:max-w-[50%]">
                @if ($game->city != null)
                    <div>
                        <span class="font-alegreya_bold">Город:</span>
                        <span class="text-base lg:text-xl">{{ $game->city->city }}</span>
                    </div>
                @endif
                <div>
                    <span class="font-alegreya_bold">Формат игры:</span>
                    <span class="text-base lg:text-xl"> {{ $game['game_format']->label() }} </span>
                </div>
                <div>
                    <span class="font-alegreya_bold">Длительность игры:</span>
                    <span class="text-base lg:text-xl"> {{ $game['game_duration']->label() }} </span>
                </div>
                <div>
                    <span class="font-alegreya_bold">Требуется:</span>
                    <span class="text-base lg:text-xl"> {{ $game['player_type_needed']->label() }} </span>
                </div>
            </div>
        </div>
        <div class="mb-2 flex items-center gap-2 flex-wrap">
            <span class="font-alegreya_bold whitespace-nowrap">
                @if (count($game['gameSystems']) > 1)
                    Игровые системы:
                @else
                    Игровая система:
                @endif
            </span>
            @foreach ($game['gameSystems'] as $system)
                <div class="bg-[#1a1a1a] text-white py-1 px-3 rounded text-base lg:text-xl">
                    {{ $system->system->game_system_name }}
                </div>
            @endforeach
        </div>

        <div class="border-t border-b border-black py-2 mt-4">
            <span class="text-base lg:text-xl font-alegreya_bold">Теги:</span>
            <span>
                @if ($game['tags'] && $game['tags']->count() > 0)
                    {{ $game['tags']->map(fn($s) => $s->tag->game_style_tag)->implode(', ') }}
                @else
                    Отсутствуют
                @endif
            </span>
        </div>
        @if ($game->game_description != null)
            <div class="font-alegreya_bold mt-4">
                Описание:
            </div>
            <div class="border border-black p-2 mt-1 text-base lg:text-xl bg-[#ced0d4] rounded">
                    <span> {{ $game->game_description }} </span>
            </div>
        @endif
        <div>
            @if ($game->user->show_contacts_others)
                <div>
                    <h2 class="text-xl lg:text-xl font-alegreya_bold mt-4 mb-1">Контакты со мной:</h2>

                    <div class="divide-y divide-[#1a1a1a] border [#1a1a1a] rounded-md overflow-hidden">
                        <!-- Заголовки -->
                        <div class="grid grid-cols-2 bg-[#2D2D2D] font-alegreya_bold text-white text-base lg:text-lg">
                            <div class="px-4 py-2 border-r border-[#1a1a1a]">Тип контакта:</div>
                            <div class="px-4 py-2">Контактные данные:</div>
                        </div>

                        <!-- Пример строки -->
                        @foreach($game->contacts as $index)
                            <div class="grid grid-cols-2 bg-white font-alegreya_bold text-base lg:text-lg">
                                <div class="px-4 py-2 border-r border-[#1a1a1a]">{{ $index->contacts->contact_method }}</div>
                                <div class="px-4 py-2">{{ $index->contact_value }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @if ($game['game_place'] != null || $game->game_date != null)
            <div class="text-lg lg:text-xl font-alegreya_bold w-full py-1 mt-2">
                @if ( $game['game_place'] != null )
                    <div class="font-alegreya_bold">Место проведения игры:
                        <span class="text-black">{{ $game['game_place'] }}</span>
                    </div>
                @endif
                <div class="flex justify-between items-center">
                    @if($game->game_date != null)
                        <span class="mr-2 font-alegreya_bold">
                            Дата: {{ \Carbon\Carbon::parse($game->game_date)->format('d.m.Y') }}
                            @if (\Carbon\Carbon::parse($game->game_date)->format('H:i') != '00:00')
                                Время: {{ \Carbon\Carbon::parse($game->game_date)->format('H:i') }}
                            @endif
                        </span>
                    @endif
                </div>
            </div>
        @endif
        <div class="flex flex-wrap justify-between items-start gap-4 text-lg lg:text-xl mt-2">
            <!-- Левая часть: Игроки и Цена -->
            @if ($game['player_type_needed']->value == 0)
                <div class="font-alegreya_bold flex-1 min-w-[200px]">
                    <div>Нужно игроков: <span class="text-black">{{ $game['player_count'] }}</span></div>
                    <div>Цена:
                        <span class="text-black">
                            @if ($game['price'] > 0)
                                {{ $game['price'] }} Рублей.
                            @else
                                Бесплатно
                            @endif
                        </span>
                    </div>
                </div>
            @endif

            <!-- Правая часть: Кнопки -->
            <div class="flex flex-wrap justify-end gap-2 flex-1 min-w-[200px] ">
                @if (Auth::user() != null && Auth::user()->user_pk == $game->author)
                    <form class="w-full sm:w-auto text-right" action="{{ route('card.delete', $game->game_session_pk) }}" method="POST" onsubmit="return confirm('Удалить эту сессию?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                            Удалить
                        </button>
                    </form>

                    <a href="{{ route('card.edit', $game) }}"
                       class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                        Редактировать
                    </a>
                @else
                    <button
                        class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                        Откликнуться
                    </button>
                @endif
            </div>
        </div>

        <div class="text-base lg:text-xl text-left sm:text-right text-[#808080] py-1">
            <div class="inline">
                Объявление создано:
            </div>
            <div class="inline whitespace-normal whitespace-nowrap">
                Дата: {{ \Carbon\Carbon::parse($game['created_at'])->format('d.m.Y') }}
                Время: {{ \Carbon\Carbon::parse($game['created_at'])->format('H:i') }}
            </div>
        </div>


    </div>
    <br>
@empty
    <div class="bg-gray-200 text-4xl py-4 font-alegreya_bold text-center rounded-lg border border-gray-400 shadow-md">
        Похоже, объявлений не найдено :(
    </div>
@endforelse
