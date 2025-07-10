@extends('layouts.MainContentPage')

@section('page_name', 'Поиск компании')

@section('content_title')
    @if (Route::currentRouteName() === 'card.edit')
        Редактировать анкету
    @else
        Создать анкету
    @endif
@endsection
@section('content')
    <form id="card-form" method="POST"
          action="{{ Route::currentRouteName() === 'card.edit'
          ? route('card.edit.accept', $cardInfo)
          : route('create.card.update') }}"
    >
        @csrf
        @if(Route::currentRouteName() === 'card.edit')
            @method('PUT')
        @endif
        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black bg-gray-200 font-alegreya_medium">
            <div class="p-4 space-y-6 md:max-w-[60%] mx-auto"
                 x-data="{
                     playerType: '{{ strval(old('player_type', isset($cardInfo) && $cardInfo->player_type_needed ? $cardInfo->player_type_needed->value : '0')) }}',
                     gameFormat: '{{ strval(old('player_type', isset($cardInfo) && $cardInfo->game_format ? $cardInfo->game_format->value : '0')) }}'
                 }"
            >
                <!-- Кого ищу -->
                <div class="mb-1 flex items-center gap-2">
                    <label for="player_type" class="block text-lg font-alegreya_bold text-gray-800">
                        Ищу*:
                    </label>
                    <!-- Подсказка -->
                    <div class="relative inline-block" x-data="tooltipComponent()">
                        <div
                            x-ref="button"
                            class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                            @mouseenter="if (window.innerWidth >= 1024) open = true"
                            @mouseleave="if (window.innerWidth >= 1024) open = false"
                            @click="toggle()"
                        >
                            ?
                        </div>
                        <div
                            x-show="open"
                            x-transition
                            :class="{
                              'left-0 transform-none': !isNearRightEdge,
                              'right-0 transform-none': isNearRightEdge
                            }"
                           class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                        >
                            Укажите тип игроков которых вы ищете, если вы мастер, то вам нужны игроки, а если вы игрок, то вам нужен мастер.
                        </div>
                    </div>
                </div>
                <select id="player_type" name="player_type"
                        x-model="playerType"
                        class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                    <option value="0" {{ old('player_type', $cardInfo->player_type_needed) == 0 ? 'selected' : '' }}>Игроков</option>
                    <option value="1" {{ old('player_type', $cardInfo->player_type_needed) == 1 ? 'selected' : '' }}>Мастера</option>
                </select>

                <!-- Кол-во игроков -->
                <div x-show="playerType === '0'">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="player_count" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Кол-во игроков*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                               class="absolute top-full mt-2 w-auto min-w-40 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Укажите кол-во игроков которое вы хотите собрать в диапазоне от 1 до 16 человек, не включая вас.
                            </div>
                        </div>
                    </div>

                    <input id="player_count" name="player_count" type="number" min="1"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           placeholder="Введите количество игроков от 1 до 16"
                           min="1"
                           max="16"
                           value="{{ old('player_count', $cardInfo->player_count ?? '') }}">
                    @error('player_count')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Формат игры -->
                <div x-data="{ gameFormat: '{{ old('game_format', '') }}' }">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="game_format" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Формат игры*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                               class="absolute top-full mt-2 w-auto min-w-40 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Уточните как именно вы хотите собраться с другими игроками, в реальной жизни или быть может онлайн, а может вам не так важно?
                            </div>
                        </div>
                    </div>
                    <select id="game_format" name="game_format"
                            x-model="gameFormat"
                            class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                        <option value="0">Вживую</option>
                        <option value="1">Онлайн</option>
                        <option value="2">Любой</option>
                    </select>
                    @error('game_format')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Игровые системы -->
                <!-- Одинарный выбор системы -->
                <template x-if="playerType === '0'">
                    <div
                        x-data="singleSelect(
                            @js($gameSystems),
                            'game_system_pk',
                            'game_system_name',
                            @js(isset(old('game_systems')[0]) ? (int)old('game_systems')[0] : ($selectedGameSystems[0] ?? null))
                        )"
                        x-init="init()"
                        class="relative">
                        <div class="mb-1 flex items-center gap-2">
                            <label class="block text-lg font-alegreya_bold text-gray-800 mb-1">Игровая система*:</label>
                            <!-- Подсказка -->
                            <div class="relative inline-block" x-data="tooltipComponent()">
                                <div
                                    x-ref="button"
                                    class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                    @mouseenter="if (window.innerWidth >= 1024) open = true"
                                    @mouseleave="if (window.innerWidth >= 1024) open = false"
                                    @click="toggle()"
                                >
                                    ?
                                </div>
                                <div
                                    x-show="open"
                                    x-transition
                                    :class="{
                                      'left-0 transform-none': !isNearRightEdge,
                                      'right-0 transform-none': isNearRightEdge
                                    }"
                                   class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                                >
                                    Укажите игровую систему в которой вы хотите провести свою кампанию.
                                </div>
                            </div>
                        </div>
                        <input
                            type="text"
                            x-model="search"
                            @click="open = true"
                            @input="open = true"
                            placeholder="Выберите систему..."
                            class="w-full px-4 py-2 rounded border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                        >

                        <!-- Список с вариантами -->
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg"
                        >
                            <template x-for="item in filteredItems()" :key="item[idKey]">
                                <div
                                    @click="choose(item)"
                                    class="cursor-pointer px-4 py-2 hover:bg-gray-200"
                                    :class="{'bg-gray-300': selected && item[idKey] === selected[idKey]}"
                                >
                                    <span x-text="item[nameKey]"></span>
                                </div>
                            </template>
                            <div x-show="filteredItems().length === 0" class="px-4 py-2 text-gray-500">Ничего не найдено</div>
                        </div>

                        <!-- Скрытое поле с ID -->
                        <template x-if="selected">
                            <input type="hidden" name="game_systems[]" :value="selected[idKey]">
                        </template>

                        <!-- Кнопка сброса -->
                        <template x-if="selected">
                            <button type="button" @click="clear" class="text-sm text-red-600 mt-1 underline">Сбросить выбор</button>
                        </template>
                    </div>
                </template>
                <!-- Множественный выбор систем -->
                <template x-if="playerType === '1'">

                    <div
                        x-data="multiSelect(@js($gameSystems), 'game_system_pk', 'game_system_name', @js(old('game_systems', $selectedGameSystems ?? null)))"
                        x-init="init()"
                        class="relative"
                    >
                        <div class="mb-1 flex items-center gap-2">
                            <label for="game_systems" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Игровые системы*:</label>
                            <!-- Подсказка -->
                            <div class="relative inline-block" x-data="tooltipComponent()">
                                <div
                                    x-ref="button"
                                    class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                    @mouseenter="if (window.innerWidth >= 1024) open = true"
                                    @mouseleave="if (window.innerWidth >= 1024) open = false"
                                    @click="toggle()"
                                >
                                    ?
                                </div>
                                <div
                                    x-show="open"
                                    x-transition
                                    :class="{
                                      'left-0 transform-none': !isNearRightEdge,
                                      'right-0 transform-none': isNearRightEdge
                                    }"
                                    class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                                >
                                    Укажите игровые системы которые вам знакомы или в которые вы хотели бы сыграть.
                                </div>
                            </div>
                        </div>
                        <input type="text"
                               x-model="search"
                               @click="open = true"
                               @input="open = true"
                               placeholder="Выберите системы..."
                               class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                        />


                        <div x-show="open"
                             @click.outside="open = false"
                             class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg"
                             style="min-width: 100%;"
                        >
                            <template x-for="item in filteredItems()" :key="item[idKey]">
                                <div @click="toggle(item)"
                                     :class="{'bg-gray-300': isSelected(item)}"
                                     class="cursor-pointer px-4 py-2 hover:bg-gray-200">
                                    <span x-text="item[nameKey]"></span>
                                </div>
                            </template>
                            <div x-show="filteredItems().length === 0" class="px-4 py-2 text-gray-500">Системы не найдены</div>
                        </div>

                        <!-- Выбранные системы -->
                        <div class="mt-2 flex flex-wrap gap-2">
                            <template x-for="item in selected" :key="item[idKey]">
                                <div class="bg-[#1a1a1a] text-white py-1 rounded flex items-center space-x-2">
                                    <span class="pl-2" x-text="item[nameKey]"></span>
                                    <button type="button"
                                            @click="remove(item)"
                                            class="font-alegreya_bold flex items-center justify-center w-5 h-5 hover:bg-[#262626]">&times;
                                    </button>
                                    <input type="hidden" :name="'game_systems[]'" :value="item[idKey]">
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
                @error('game_systems')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <!-- Длительность игры -->
                <div x-data="{ game_duration: '{{ old('game_duration', '') }}' }">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="game_duration" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Длительность игры*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Уточните, в насколько длинную игру вы хотели бы сыграть.<br>
                                <strong>Ваншот</strong> — игра, которая длится одну встречу, в среднем около четырёх часов.<br>
                                <strong>Кампания</strong> — длительное приключение, которое состоит из нескольких встреч.
                            </div>
                        </div>
                    </div>
                    @php
                        $selectedDuration = old('game_duration', isset($cardInfo) ? $cardInfo->game_duration?->value : null);
                    @endphp

                    <select id="game_duration" name="game_duration"
                            x-model="game_duration"
                            class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]">
                        <option value="0" {{ strval($selectedDuration) === '0' ? 'selected' : '' }}>Ваншот (Одна игра)</option>
                        <option value="1" {{ strval($selectedDuration) === '1' ? 'selected' : '' }}>Кампания (Больше одной игры)</option>
                        <option value="2" {{ strval($selectedDuration) === '2' ? 'selected' : '' }}>Ваншот с возможностью перейти в кампанию</option>
                    </select>
                    @error('game_duration')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Теги -->
                <div
                    x-data="multiSelect(@js($gameTags), 'game_style_tag_pk', 'game_style_tag',  @js(old('game_tags', $selectedGameTags ?? null)))"
                    x-init="init()"
                    class="relative"
                >
                    <div class="mb-1 flex items-center gap-2">
                        <label for="game_tags" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Теги:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Укажите теги, которые, как вы считаете, рассказали бы о стиле вашего приключения или его чертах.<br>
                                <strong>Не является обязательным полем для заполнения.</strong>
                            </div>
                        </div>
                    </div>
                    <input type="text"
                           x-model="search"
                           @click="open = true"
                           @input="open = true"
                           placeholder="Выберите теги..."
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                    />

                    <div x-show="open"
                         @click.outside="open = false"
                         class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg"
                         style="min-width: 100%;"
                    >
                        <template x-for="item in filteredItems()" :key="item[`${idKey}`]">
                            <div @click="toggle(item)"
                                 :class="{'bg-gray-300': isSelected(item)}"
                                 class="cursor-pointer px-4 py-2 hover:bg-gray-200">
                                <span x-text="item[`${nameKey}`]"></span>
                            </div>
                        </template>
                        <div x-show="filteredItems().length === 0" class="px-4 py-2 text-gray-500">Теги не найдены</div>
                    </div>

                    <!-- Выбранные теги -->
                    <div class="mt-2 flex flex-wrap gap-2">
                        <template x-for="item in selected" :key="item[`${idKey}`]">
                            <div class="bg-[#1a1a1a] text-white py-1 rounded flex items-center space-x-2">
                                <span class="pl-2" x-text="item[`${nameKey}`]"></span>
                                <button type="button"
                                        @click="remove(item)"
                                        class="font-alegreya_bold flex items-center justify-center w-5 h-5 hover:bg-[#262626]">&times;
                                </button>
                                <input type="hidden" :name="'game_tags[]'" :value="item[`${idKey}`]">
                            </div>
                        </template>
                    </div>

                    @error('game_tags')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Описание -->
                <div>
                    <div class="mb-1 flex items-center gap-2">
                        <label for="description" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Описание:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Здесь вы можете описать всё что хотите, если вы игрок, то можете рассказать свои ожидания от игры,
                                а если мастер, то можете разместить здесь раздаточный материал.<br>
                                <strong>Не является обязательным полем для заполнения.</strong>
                            </div>
                        </div>
                    </div>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                              placeholder="Расскажите подробнее чего вы ожидаете от игры...">{{ old('description', $cardInfo->game_description) ?? null }}</textarea>
                    @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Город -->
                <div x-show="gameFormat != '1'"
                     x-data="citySelect(@js($cityList),  {{ old('city_id', $cardInfo->city_pk ?? 'null') }})"
                     x-init="init()"
                     class="relative"
                >
                    <div class="mb-1 flex items-center gap-2">
                        <label for="city" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Город*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Укажите город в котором вы собираетесь играть.<br>
                                Выберете 'Другой' если по какой-то причине вашего города нет в списке.
                            </div>
                        </div>
                    </div>
                    <input id="city"
                           x-model="search"
                           @click="open = true"
                           @input="open = true"
                           @input="updateSelection"
                           type="text"
                           placeholder="Выберете город проведения..."
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           autocomplete="off"
                    />

                    <!-- Выпадающий список -->
                    <div x-show="open && filtered.length > 0"
                         @click.outside="open = false"
                         class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto shadow-lg w-full">
                        <template x-for="city in filtered" :key="city.city_pk">
                            <div @click="select(city)"
                                 class="cursor-pointer px-4 py-2 hover:bg-gray-200"
                                 :class="{ 'bg-gray-300': city.city === search }">
                                <span x-text="city.city"></span>
                            </div>
                        </template>
                    </div>

                    <!-- Скрытое поле с ID выбранного города -->
                    <input type="hidden" name="city_id" :value="selected?.city_pk ?? ''">
                    @error('city_id')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Место проведения игры -->
                <div x-show="gameFormat != '1' && playerType != '1'">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="game_place" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Место проведения игры:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Если вы собираетесь в живую, то укажите адрес, если вы собираетесь онлайн,
                                то укажите место в котором вы собираетесь провести свою игру.<br>
                                <strong>Не является обязательным полем для заполнения.</strong>
                            </div>
                        </div>
                    </div>
                    <input id="game_place" name="game_place"
                              class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                              placeholder="Адрес или место в онлайн формате где будет проводится игра"
                              value="{{ old('game_place', $cardInfo->game_place ?? '') }}"></input>
                    @error('game_place')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Дата проведения -->
                @php
                    $gameDate = isset($cardInfo->game_date) ? \Carbon\Carbon::parse($cardInfo->game_date) : null;
                @endphp
                <div x-show="playerType === '0'">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="date" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Дата проведения:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-45 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Если у вашей игры есть назначенная дата проведения, то укажите её здесь<br>
                                <strong>Не является обязательным полем для заполнения.</strong>
                            </div>
                        </div>
                    </div>
                    <input id="date" name="date" type="date"
                           min="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           value="{{ old('date', $gameDate?->format('Y-m-d')) }}">
                    @error('date')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Время проведения -->
                <div x-show="playerType === '0'">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="time" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Время проведения:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Если вы хотите собрать игру в определённое время, то укажите его здесь,
                                используйте свой часовой пояс,
                                для других пользователей время автоматически будет конвертировано под их часовой пояс.<br>
                                <strong>Не является обязательным полем для заполнения.</strong>
                            </div>
                        </div>
                    </div>
                    <input id="time" name="time" type="time"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           value="{{ old('time', $gameDate?->format('H:i')) }}">
                    @error('time')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Цена -->
                <div x-show="playerType === '0'">
                    <div class="mb-1 flex items-center gap-2">
                        <label for="price" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Цена (₽):</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-50 sm:min-w-60 max-w-50 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Если вы собираетесь провести игру платно, то укажите цену здесь, в ином случае оставьте поле пустым или укажите 0.<br>
                                <strong>Не является обязательным полем для заполнения.</strong>
                            </div>
                        </div>
                    </div>
                    <input id="price" name="price" type="number" min="0" max="100000" step="0.01"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4f4f4f]"
                           placeholder="Введите цену"
                           value="{{ old('price', $cardInfo->price ?? '') }}">
                    @error('price')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Контактная информация -->
                <div x-data="contactMethodsComponent(@js($contactTypes), @js(old('contacts_data', $knownContacts ?? [])))" x-init="init()">
                    <div class="mb-1 flex items-center gap-2">
                        <label class="block text-lg font-alegreya_bold text-gray-800 mb-1">Контактная информация*:</label>
                        <!-- Подсказка -->
                        <div class="relative inline-block" x-data="tooltipComponent()">
                            <div
                                x-ref="button"
                                class="flex items-center justify-center w-5 h-5 text-xl rounded-full bg-[#2D2D2D] text-white font-bold cursor-pointer select-none"
                                @mouseenter="if (window.innerWidth >= 1024) open = true"
                                @mouseleave="if (window.innerWidth >= 1024) open = false"
                                @click="toggle()"
                            >
                                ?
                            </div>
                            <div
                                x-show="open"
                                x-transition
                                :class="{
                                  'left-0 transform-none': !isNearRightEdge,
                                  'right-0 transform-none': isNearRightEdge
                                }"
                                class="absolute top-full mt-2 w-auto min-w-60 sm:max-w-xs p-2 bg-white text-black text-sm rounded z-50"
                            >
                                Укажите контактную информацию с помощью которой другие пользователи смогут с вами связаться.
                                По умолчанию другие пользователи не видят эти данные без вашего разрешения,
                                вы можете изменить это в настройках аккаунта.
                            </div>
                        </div>
                    </div>

                    <div class="divide-y divide-[#1a1a1a] border border-[#1a1a1a] rounded-md overflow-visible bg-[#2D2D2D]">

                        <!-- Заголовки -->
                        <div class="grid grid-cols-[1fr_1fr_auto] bg-[#2D2D2D] font-alegreya_bold text-white text-xs lg:text-lg">
                            <div class="px-2 lg:px-4 py-2 border-r border-[#1a1a1a]">Тип контакта:</div>
                            <div class="px-2 lg:px-4 py-2 border-r border-[#1a1a1a]">Контактные данные:</div>
                            <!-- Кнопка добавить -->
                            <div class="p-1 lg:p-2">
                                <button
                                    type="button"
                                    @click="addRow()"
                                    class="bg-white  w-[1.55rem] h-[1.55rem] lg:w-[2.25rem] lg:h-[2.25rem] text-2xl lg:text-4xl text-black hover:bg-gray-300 flex items-center justify-center rounded leading-none">
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Строки -->
                        <template x-for="(row, index) in rows" :key="row.id">
                            <div class="grid grid-cols-[1fr_1fr_auto] bg-white font-alegreya_bold text-xs lg:text-lg items-center">

                                <!-- Тип контакта -->
                                <div class="px-2 lg:px-4 py-2 border-r border-[#1a1a1a] relative overflow-visible"
                                     x-data="singleSelect(@js($contactTypes), 'contact_methods_pk', 'contact_method', row.type)"
                                     x-init="init(selectedValue = row.type)">
                                    <input type="text"
                                           x-model="search"
                                           @click="open = true"
                                           @input="open = true"
                                           class="w-full px-2 py-1 border border-black rounded"
                                           placeholder="Выберите тип">
                                    <ul x-show="open" @click.outside="open = false"
                                        class="absolute z-50 w-full bg-white border border-black rounded mt-1 max-h-40 overflow-y-auto"
                                        style="top: 100%; left: 0;">
                                        <template x-for="item in filteredItems()" :key="item.contact_methods_pk">
                                            <li @click="choose(item)"
                                                class="px-2 py-1 hover:bg-gray-200 cursor-pointer"
                                                x-text="item.contact_method"></li>
                                        </template>
                                    </ul>
                                    <input type="hidden" :name="'contacts[]'" :value="selected ? selected.contact_methods_pk : ''" x-model="row.type">
                                </div>

                                <!-- Значение контакта -->
                                <div class="px-2 lg:px-4 py-2 border-r border-[#1a1a1a]">
                                    <input type="text"
                                           class="w-full px-2 py-1 border border-black rounded"
                                           placeholder="Введите данные"
                                           :name="'contact_values[]'"
                                           x-model="row.value"
                                    >
                                </div>

                                <!-- Кнопка удалить -->
                                <div class="lg:p-2 lg:p-2 w-[2.05rem] h-[2.05rem] lg:w-[3.25rem] lg:h-[3.25rem]">
                                    <button
                                        type="button"
                                        @click="removeRow(index)"
                                        class="w-7 h-7 icon-trash flex items-center justify-center rounded">
                                        <img src="{{ asset('storage/icons/trash.svg') }}" alt="trash icon" class="w-5 h-5" />
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                @error('contacts')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                @error('contact_values')
                <div class="text-red-500">{{ $message }}</div>
                @enderror

            </div>

            <!-- Нижние кнопки -->
            <div class="bg-[#2D2D2D] p-4 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ url()->previous() }}"
                   class="text-center text-xl bg-white text-black font-alegreya_bold px-5 py-2 rounded hover:bg-[#ababab] transition w-full sm:w-60">
                    Назад
                </a>
                <button type="submit"
                        class="text-center text-xl bg-white text-black font-alegreya_bold px-5 py-2 rounded hover:bg-[#ababab] transition w-full sm:w-60 cursor-pointer">
                    {{ Route::currentRouteName() === 'card.edit' ? 'Обновить' : 'Создать' }}
                </button>
            </div>

        </div>
    </form>
@endsection
