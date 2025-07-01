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
                        onerror="this.onerror=null;this.src='{{ asset('storage/avatars/default_avatar.png') }}';"
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
                <div class="font-alegreya_bold flex-1 min-w-[200px] w-full sm:max-w-[30%]">
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
            <div class="flex flex-wrap justify-end gap-2 flex-1 min-w-[200px] mt-2">
                @if (Auth::user() != null && Auth::user()->user_pk == $game->author)
                    <div x-data="deleteModal()" class="relative w-full sm:w-auto">
                        <form id="delete-form-{{ $game->game_session_pk }}" class="w-full sm:w-auto text-right" action="{{ route('card.delete', $game->game_session_pk) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    @click="openModal('delete-form-{{ $game->game_session_pk }}')"
                                    class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                                Удалить
                            </button>
                        </form>

                        <!-- Модальное окно -->
                        <div x-show="isOpen" x-transition class="fixed inset-0 flex items-center justify-center z-50">
                            <!-- Чёрный прозрачный фон -->
                            <div class="absolute inset-0 bg-black opacity-40"></div>
                            <!-- Само модальное окно -->
                            <div @click.outside="closeModal()"
                                 class="relative z-10 bg-[#2D2D2D] border-2 border-black rounded-lg p-6 w-full max-w-md shadow-xl text-white">
                                <h2 class="text-2xl mb-4 font-alegreya_bold">Подтверждение удаления</h2>
                                <p class="mb-6">Вы уверены, что хотите удалить эту сессию? Это действие необратимо.</p>
                                <div class="flex justify-center gap-4 w-full">
                                    <button @click="closeModal()"
                                            class="w-1/2 px-4 py-2 rounded bg-white hover:bg-[#8c8c8c] transition text-black border border-black">
                                        Отмена
                                    </button>
                                    <button @click="confirmDelete()"
                                            class="w-1/2 px-4 py-2 rounded bg-[#820909] text-white hover:bg-[#540505] transition border border-black">
                                        Удалить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('card.edit', $game) }}"
                       class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                        Редактировать
                    </a>
                @elseif(Auth::user() == null)
                    <a href="{{ route('login') }}"
                       class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                        Откликнутся
                    </a>
                @elseif($game->playerInviteForCurrentUser != null)
                    <a class="sm:w-auto text-center w-full font-alegreya_bold mt-2">Статус приглашения:
                        @if ($game->playerInviteForCurrentUser->invite_status == 0 )
                            Расматривается
                        @elseif($game->playerInviteForCurrentUser->invite_status == 1)
                            Ваш запрос принят
                        @else
                            Ваш запрос отклонён
                        @endif
                    </a>
                @else
                    <div
                        x-data="{
                            successMessage: null,
                            loading: false,
                            submitForm() {
                                if (this.loading) return;
                                this.loading = true;
                                this.successMessage = null;

                                fetch('{{ route('room.join', $game) }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({})
                                })
                                .then(response => {
                                    if (!response.ok) throw new Error('Ошибка при отклике');
                                    return response.json();
                                })
                                .then(data => {
                                    this.successMessage = data.message || 'Вы откликнулись!';
                                })
                                .catch(error => {
                                    this.successMessage = 'Произошла ошибка';
                                })
                                .finally(() => {
                                    this.loading = false;
                                });
                            }
                        }"
                        class="flex flex-col items-end gap-2 w-full"
                    >
                        <button @click="submitForm"
                                type="button"
                                x-show="successMessage === null"
                                :disabled="loading || successMessage !== null"
                                class="sm:w-60 bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white rounded px-4 py-2 transition text-base sm:text-lg w-full disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <template x-if="loading">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                            </template>
                            <span x-text="loading ? 'Отправка...' : 'Откликнуться'"></span>
                        </button>

                        <template x-if="successMessage !== null">
                            <div class="sm:w-auto text-center sm:text-right w-full font-alegreya_bold text-black" x-text="successMessage"></div>
                        </template>
                    </div>

                @endif
                    <a href="{{ route('room', $game) }}"
                       class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white w-full sm:w-60 text-center rounded px-4 py-2 transition text-base sm:text-lg">
                        Подробнее
                    </a>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-2 py-1">
            <div class="text-base lg:text-xl text-[#808080] text-right">
                <span class="inline">Объявление создано:</span>
                <span class="inline whitespace-nowrap ml-1">
            Дата: {{ \Carbon\Carbon::parse($game['created_at'])->format('d.m.Y') }}
            Время: {{ \Carbon\Carbon::parse($game['created_at'])->format('H:i') }}
        </span>
            </div>
        </div>

    </div>
    <br>
@empty
    <div class="bg-gray-200 text-4xl py-4 font-alegreya_bold text-center rounded-lg border border-gray-400 shadow-md">
        Похоже, объявлений не найдено :(
    </div>
@endforelse
