@extends('layouts.MainContentPage')

@section('page_name', 'Поиск компании')

@section('content_title', 'Комната')

@section('content')
    <div
        class="mx-auto bg-gray-200 rounded-lg border border-gray-400 px-4 shadow-md font-serif text-xl leading-tight font-alegreya_medium">
        <div class="flex flex-wrap justify-center sm:justify-between items-start gap-4 mt-2">
            <!-- Левая часть: информация о пользователе -->
            <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start mt-4 gap-3 min-w-0 max-w-full 2xl:max-w-[48%]">
                <a href="{{ route('profile', $room['user']) }}" class="flex flex-col sm:flex-row items-center justify-center sm:justify-start gap-3 min-w-0 max-w-full w-full">
                    <!-- Аватар -->
                    <img
                        src="{{ asset('storage/' . $room['user']->avatar) }}"
                        alt="Аватар"
                        class="w-24 h-24 rounded-full object-cover border-2 border-black shadow-md cursor-pointer shrink-0"
                        onerror="this.onerror=null;this.src='{{ asset('storage/avatars/default_avatar.png') }}';"
                    />

                    <!-- Имя и рейтинг -->
                    <div class="text-center font-alegreya_medium text-4xl break-words sm:text-left w-full max-w-full truncate">
                        {{ $room['user']->user_name }}
                    </div>
                </a>
            </div>

            <div class="flex flex-col space-y-1 font-alegreya_bold text-xl lg:text-2xl w-full sm:w-auto sm:max-w-[50%]">
                @if ($room->city != null)
                    <div>
                        <span class="font-alegreya_bold">Город:</span>
                        <span class="text-base lg:text-xl">{{ $room->city->city }}</span>
                    </div>
                @endif
                <div>
                    <span class="font-alegreya_bold">Формат игры:</span>
                    <span class="text-base lg:text-xl"> {{ $room['game_format']->label() }} </span>
                </div>
                <div>
                    <span class="font-alegreya_bold">Длительность игры:</span>
                    <span class="text-base lg:text-xl"> {{ $room['game_duration']->label() }} </span>
                </div>
                <div>
                    <span class="font-alegreya_bold">Требуется:</span>
                    <span class="text-base lg:text-xl"> {{ $room['player_type_needed']->label() }} </span>
                </div>
            </div>
        </div>
        <div class="mb-2 flex items-center gap-2 flex-wrap">
            <span class="font-alegreya_bold whitespace-nowrap">
                @if (count($room['gameSystems']) > 1)
                    Игровые системы:
                @else
                    Игровая система:
                @endif
            </span>
            @foreach ($room['gameSystems'] as $system)
                <div class="bg-[#1a1a1a] text-white py-1 px-3 rounded text-base lg:text-xl">
                    {{ $system->system->game_system_name }}
                </div>
            @endforeach
        </div>

        <div class="border-t border-b border-black py-2 mt-4">
            <span class="text-base lg:text-xl font-alegreya_bold">Теги:</span>
            <span>
                @if ($room['tags'] && $room['tags']->count() > 0)
                    {{ $room['tags']->map(fn($s) => $s->tag->game_style_tag)->implode(', ') }}
                @else
                    Отсутствуют
                @endif
            </span>
        </div>
        @if ($room->game_description != null)
            <div class="font-alegreya_bold mt-4">
                Описание:
            </div>
            <div class="border border-black p-2 mt-1 text-base lg:text-xl bg-[#ced0d4] rounded">
                <span> {{ $room->game_description }} </span>
            </div>
        @endif
        <div>
            @if ($room->user->show_contacts_others ||
                (Auth::check() && Auth::user()->user_pk == $room->author) ||
                ($room->playerInviteForCurrentUser && $room->playerInviteForCurrentUser->invite_status == 1))
                <div>
                    <h2 class="text-xl lg:text-xl font-alegreya_bold mt-4 mb-1">Контакты со мной:</h2>

                    <div class="divide-y divide-[#1a1a1a] border [#1a1a1a] rounded-md overflow-hidden">
                        <!-- Заголовки -->
                        <div class="grid grid-cols-2 bg-[#2D2D2D] font-alegreya_bold text-white text-base lg:text-lg">
                            <div class="px-4 py-2 border-r border-[#1a1a1a]">Тип контакта:</div>
                            <div class="px-4 py-2">Контактные данные:</div>
                        </div>

                        <!-- Пример строки -->
                        @foreach($room->contacts as $index)
                            <div class="grid grid-cols-2 bg-white font-alegreya_bold text-base lg:text-lg">
                                <div class="px-4 py-2 border-r border-[#1a1a1a]">{{ $index->contacts->contact_method }}</div>
                                <div class="px-4 py-2">{{ $index->contact_value }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

                <div>
                    <h2 class="text-xl lg:text-xl font-alegreya_bold mt-4 mb-1">Список участников:</h2>

                    <div class="w-full divide-y divide-[#1a1a1a] border [#1a1a1a] rounded-md overflow-hidden">
                        <!-- Заголовки -->
                        <div class="grid grid-cols-{{ Auth::check() &&  Auth::user()->user_pk == $room->author ? '2' : '1' }} font-alegreya_bold text-white text-base lg:text-lg">
                            <div class="px-4 py-2 border-r border-[#1a1a1a] bg-[#2D2D2D]">Имя пользователя:</div>
                            @if(Auth::check() && Auth::user()->user_pk == $room->author)
                                <div class="px-4 py-2 bg-[#2D2D2D]">Действия:</div>
                            @endif
                        </div>

                        @if($room->userList->every(fn($user) => $user->invite_status != 1) && (Auth::check() && Auth::user()->user_pk != $room->author))
                            <div class="flex justify-start gap-2 px-4 py-2 bg-white">
                                Здесь пока никого нет
                            </div>
                        @elseif($room->userList->every(fn($user) => $user->invite_status == 2))
                            <div class="flex justify-start gap-2 px-4 py-2 bg-white">
                                Здесь пока никого нет
                            </div>
                        @endif
                        <!-- Строки -->
                        @foreach($room->userList as $user)
                            @if($user->invite_status == 1 || Auth::check() && Auth::user()->user_pk == $room->author)
                                @if($user->invite_status != 2)
                                    <div class="grid grid-cols-{{ Auth::check() &&  Auth::user()->user_pk == $room->author ? '2' : '1' }} font-alegreya_bold text-base lg:text-lg">
                                            <!-- Имя пользователя -->
                                            <div class="px-4 py-2 border-r border-[#1a1a1a] bg-white">

                                                    {{ $user->user->user_name }}

                                            </div>
                                        <!-- Кнопки -->
                                        @if(Auth::check() && Auth::user()->user_pk == $room->author)
                                            <div class="flex justify-start gap-2 px-4 py-2 bg-white">
                                                @if($user->invite_status == 0)
                                                    <!-- Кнопка "Принять" -->
                                                    <form x-data="{ loading: false }"
                                                          @submit="loading = true"
                                                          action="{{ route('accept_invite', ['room' => $room, 'notice' => $user->noticeForAuthor]) }}"
                                                          method="POST"
                                                          class="w-full sm:w-auto">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                :disabled="loading"
                                                                class="flex items-center justify-center bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-32 disabled:opacity-50 disabled:cursor-not-allowed">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="h-5 w-5 block sm:hidden"
                                                                 viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                      d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                                                                      clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="hidden sm:block" x-show="!loading">Принять</span>
                                                            <span class="hidden sm:block" x-show="loading">Отправка...</span>
                                                        </button>
                                                    </form>

                                                    <!-- Кнопка "Отклонить" -->
                                                    <form x-data="{ loading: false }"
                                                          @submit="loading = true"
                                                          action="{{ route('not_accept_invite', ['room' => $room, 'notice' => $user->noticeForAuthor]) }}"
                                                          method="POST"
                                                          class="w-full sm:w-auto">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                :disabled="loading"
                                                                class="flex items-center justify-center bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-32 disabled:opacity-50 disabled:cursor-not-allowed">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="h-5 w-5 block sm:hidden"
                                                                 viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                      d="M10 8.586l-3.293-3.293a1 1 0 00-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 001.414 1.414L10 11.414l3.293 3.293a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 00-1.414-1.414L10 8.586z"
                                                                      clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="hidden sm:block" x-show="!loading">Отклонить</span>
                                                            <span class="hidden sm:block" x-show="loading">Отправка...</span>
                                                        </button>
                                                    </form>
                                                @elseif($user->invite_status == 1)
{{--                                                    <!-- Кнопка "Выгнать" -->--}}
{{--                                                    <form class="w-full sm:w-auto" action="{{ route('not_accept_invite', ['room' => $room, 'notice' => $user->noticeForAuthor]) }}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('PUT')--}}
{{--                                                        <button type="submit"--}}
{{--                                                                class="flex items-center justify-center bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-32">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                 class="h-5 w-5 block sm:hidden"--}}
{{--                                                                 viewBox="0 0 20 20"--}}
{{--                                                                 fill="currentColor">--}}
{{--                                                                <path fill-rule="evenodd" d="M10 8.586l-3.293-3.293a1 1 0 00-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 001.414 1.414L10 11.414l3.293 3.293a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />--}}
{{--                                                            </svg>--}}
{{--                                                            <span class="hidden sm:block">Выгнать</span>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>

        </div>
        @if ($room['game_place'] != null || $room->game_date != null)
            <div class="text-lg lg:text-xl font-alegreya_bold w-full py-1 mt-2">
                @if ( $room['game_place'] != null )
                    <div class="font-alegreya_bold">Место проведения игры:
                        <span class="text-black">{{ $room['game_place'] }}</span>
                    </div>
                @endif
                <div class="flex justify-between items-center">
                    @if($room->game_date != null)
                        <span class="mr-2 font-alegreya_bold">
                            Дата: {{ \Carbon\Carbon::parse($room->game_date)->format('d.m.Y') }}
                            @if (\Carbon\Carbon::parse($room->game_date)->format('H:i') != '00:00')
                                Время: {{ \Carbon\Carbon::parse($room->game_date)->format('H:i') }}
                            @endif
                        </span>
                    @endif
                </div>
            </div>
        @endif
        <div class="flex flex-wrap justify-between items-start gap-4 text-lg lg:text-xl mt-2">
            <!-- Левая часть: Игроки и Цена -->
            @if ($room['player_type_needed']->value == 0)
                <div class="font-alegreya_bold flex-1 min-w-[200px]">
                    <div>Нужно игроков: <span class="text-black">{{ $room['player_count'] }}</span></div>
                    <div>Цена:
                        <span class="text-black">
                            @if ($room['price'] > 0)
                                {{ $room['price'] }} Рублей.
                            @else
                                Бесплатно
                            @endif
                        </span>
                    </div>
                </div>
            @endif

            <!-- Правая часть: Кнопки -->
            <div class="flex flex-wrap justify-end gap-2 flex-1 min-w-[200px] ">
                @if (Auth::user() != null && Auth::user()->user_pk == $room->author)
                    <form class="w-full sm:w-auto text-right" action="{{ route('card.delete', $room->game_session_pk) }}" method="POST" onsubmit="return confirm('Удалить эту сессию?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                            Удалить
                        </button>
                    </form>

                    <a href="{{ route('card.edit', $room) }}"
                       class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                        Редактировать
                    </a>
                @elseif(Auth::user() == null)
                    <a href="{{ route('login') }}"
                       class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-4 py-2 transition text-base sm:text-lg w-full sm:w-60">
                        Откликнутся
                    </a>
                @elseif($room->playerInviteForCurrentUser == null)
                    <div
                        x-data="{
                            successMessage: '',
                            submitForm() {
                                fetch('{{ route('room.join', $room) }}', {
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
                                });
                            }
                        }"
                        class="flex flex-col items-end gap-2 w-full"
                    >
                        <template x-if="!successMessage">
                            <button @click="submitForm"
                                    type="button"
                                    class="sm:w-60 bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white rounded px-4 py-2 transition text-base sm:text-lg w-full">
                                Откликнуться
                            </button>
                        </template>
                        <template x-if="successMessage">
                            <div class="sm:w-auto text-center sm:text-right w-full font-alegreya_bold" x-text="successMessage"></div>
                        </template>
                    </div>
                @endif
            </div>
        </div>

        <div class="text-base lg:text-xl text-left sm:text-right text-[#808080] py-1">
            <div class="inline">
                Объявление создано:
            </div>
            <div class="inline whitespace-normal whitespace-nowrap">
                Дата: {{ \Carbon\Carbon::parse($room['created_at'])->format('d.m.Y') }}
                Время: {{ \Carbon\Carbon::parse($room['created_at'])->format('H:i') }}
            </div>
        </div>


    </div>
@endsection

