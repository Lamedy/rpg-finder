@extends('layouts.MainContentPage')

@section('page_name', 'Мои анкеты')

@section('content_title', 'Профиль')

@section('content')
        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black bg-gray-200">
            <div class="p-4 space-y-6">
                <div class="flex justify-between items-start space-x-6">
                    <!-- Левая часть: аватар и имя -->
                    <div class="flex items-center space-x-3">
                        <img
                            src="{{ asset('storage/' . $user->avatar) }}"
                            alt="Аватар"
                            class="w-32 h-32 rounded-full object-cover border-2 border-black shadow-md"
                        />
                        <label for="player_type" class="text-5xl px-2 font-alegreya_medium">{{ $user->user_name }}</label>
                    </div>

                    <!-- Правая часть: список -->
                    <div class="flex flex-col basis-1/3 space-y-2 font-alegreya_bold text-lg">
                        <!-- Пол -->
                        <div class="flex items-center space-x-2">
                            <span class="text-lg whitespace-nowrap">Пол: </span>
                            <span name="role" class="w-full px-2 py-1 rounded-md border border-black">
                                {{ $gender }}
                            </span>
                        </div>
                        <!-- Дата рождения -->
                        <div class="flex items-center space-x-2">
                            <span class="text-lg whitespace-nowrap">Дата рождения:</span>
                            <span type="date" name="birthdate"
                                   class="w-full px-2 py-1 rounded-md border border-[#1a1a1a]">
                                {{ \Carbon\Carbon::parse($user->birthdate)->format('d.m.Y') }}
                            </span>
                        </div>
                        <!-- Город -->
                        <div class="flex items-center space-x-2">
                            <span class="text-lg whitespace-nowrap">Город:</span>
                            <span type="text" name="city" placeholder="Город"
                                   class="w-full px-2 py-1 rounded-md border border-[#1a1a1a]">
                                @if (isset($city))
                                    {{ $city }}
                                @else
                                    Не указан
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Роль -->
                <h2 class="text-2xl font-alegreya_bold mb-1">Предпочитаю роль: {{ $role }}</h2>

                <!-- Игровые системы -->
                @if ($user->gameSystemsList && $user->gameSystemsList->count() > 0)
                    <div>
                        <h2 class="text-2xl font-alegreya_bold mb-1">Знакомые мне игровые системы:</h2>

                        <div class="divide-y divide-[#1a1a1a] border [#1a1a1a] rounded-md overflow-hidden">
                            <!-- Заголовки -->
                            <div class="grid grid-cols-2 bg-[#2D2D2D] font-alegreya_bold text-white text-lg">
                                <div class="px-4 py-2 border-r border-[#1a1a1a]">Игровая система</div>
                                <div class="px-4 py-2">Игровой опыт</div>
                            </div>

                            <!-- Пример строки -->
                            @foreach($user->gameSystemsList as $index)
                            <div class="grid grid-cols-2 bg-white font-alegreya_bold text-lg">
                                <div class="px-4 py-2 border-r border-[#1a1a1a]">{{ $index->system->game_system_name }}</div>
                                <div class="px-4 py-2">{{ $index->experience->game_experience_description }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Игровые теги -->
                @php
                    $tagNames = $user->userTagsList->pluck('tags')->filter()->pluck('game_style_tag')->implode(', ');
                @endphp
                @if ($user->userTagsList->isNotEmpty())
                    <div class="border-b border-black font-alegreya_bold mb-1">
                        <span class="text-2xl block mb-2">Теги моих интересов:</span>
                        <div class="flex flex-wrap gap-2 border-t py-2">
                            @foreach ($user->userTagsList as $tagList)
                                @if ($tagList->tags)
                                    <div class="bg-[#1a1a1a] text-white py-1 px-3 rounded">
                                        {{ $tagList->tags->game_style_tag }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Контактные данные -->
                @if ($user->userContactsList && $user->userContactsList->count() > 0)
                    <div>
                        <h2 class="text-2xl font-alegreya_bold mt-4 mb-1">Контакты со мной:</h2>

                        <div class="divide-y divide-[#1a1a1a] border [#1a1a1a] rounded-md overflow-hidden">
                            <!-- Заголовки -->
                            <div class="grid grid-cols-2 bg-[#2D2D2D] font-alegreya_bold text-white text-lg">
                                <div class="px-4 py-2 border-r border-[#1a1a1a]">Тип контакта:</div>
                                <div class="px-4 py-2">Контактные данные:</div>
                            </div>

                            <!-- Пример строки -->
                            @foreach($user->userContactsList as $index)
                                <div class="grid grid-cols-2 bg-white font-alegreya_bold text-lg">
                                    <div class="px-4 py-2 border-r border-[#1a1a1a]">{{ $index->contacts->contact_method }}</div>
                                    <div class="px-4 py-2">{{ $index->contact_value }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Нижняя кнопка -->
            <div class="bg-[#2D2D2D] px-6 py-4 flex justify-center space-x-4 font-alegreya_bold">
                <a href="{{ url()->previous() }}"
                   class="text-center bg-white text-black font-alegreya_bold px-5 py-2 rounded hover:bg-[#ababab] transition w-60">
                    Назад
                </a>
                @if (Auth::user() && Auth::user()->user_pk == $user->user_pk )
                <a href="{{ route('profile.edit', $user) }}"
                        class="text-center bg-white text-black font-alegreya_bold px-5 py-2 rounded hover:bg-[#ababab] transition w-60">
                    Редактировать
                </a>
                @endif
            </div>
        </div>
@endsection

