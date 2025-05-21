@extends('layouts.MainContentPage')

@section('page_name', 'Поиск компании')

@section('content_title', 'Создать анкету')

@section('content')
    <form id="card-form" method="POST" action="{{ route('create.card.update') }}">
        @csrf
        <div class="max-w-2xl mx-auto rounded-md overflow-hidden shadow-lg border border-black bg-gray-200">
            <div class="p-4 space-y-6" x-data="{ playerType: '0', gameFormat: '0' }">

                <!-- Кого ищу -->
                <div>
                    <label for="player_type" class="block text-lg font-bold text-gray-800 mb-1">Ищу:</label>
                    <select id="player_type" name="player_type"
                            x-model="playerType"
                            class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="0">Игроков</option>
                        <option value="1">Мастера</option>
                    </select>
                    @error('player_type')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Кол-во игроков -->
                <div x-show="playerType === '0'">
                    <label for="player_count" class="block text-lg font-bold text-gray-800 mb-1">Кол-во игроков:</label>
                    <input id="player_count" name="player_count" type="number" min="1"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Введите количество игроков">
                    @error('player_count')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Формат игры -->
                <div>
                    <label for="game_format" class="block text-lg font-bold text-gray-800 mb-1">Формат игры:</label>
                    <select id="game_format" name="game_format"
                            x-model="gameFormat"
                            class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="0">В живую</option>
                        <option value="1">Онлайн</option>
                        <option value="2">Любой</option>
                    </select>
                    @error('game_format')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Игровые системы -->
                <div
                    x-data="multiSelect(@js($gameSystems), 'game_system_pk', 'game_system_name')"
                    class="relative"
                >
                    <label for="game_systems" class="block text-lg font-bold text-gray-800 mb-1">Игровые системы:</label>

                    <input type="text"
                           x-model="search"
                           @focus="open = true"
                           @keydown.escape="open = false"
                           placeholder="Начните вводить название системы..."
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    />

                    <div x-show="open"
                         @mousedown.away="open = false"
                         class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg"
                         style="min-width: 100%;"
                    >
                        <template x-for="item in filteredItems()" :key="item[idKey]">
                            <div @click="toggle(item)"
                                 :class="{'bg-blue-100': isSelected(item)}"
                                 class="cursor-pointer px-4 py-2 hover:bg-blue-200">
                                <span x-text="item[nameKey]"></span>
                            </div>
                        </template>
                        <div x-show="filteredItems().length === 0" class="px-4 py-2 text-gray-500">Системы не найдены</div>
                    </div>

                    <!-- Выбранные системы -->
                    <div class="mt-2 flex flex-wrap gap-2">
                        <template x-for="item in selected" :key="item[idKey]">
                            <div class="bg-blue-200 text-blue-800 px-3 py-1 rounded flex items-center space-x-2">
                                <span x-text="item[nameKey]"></span>
                                <button type="button" @click="remove(item)" class="font-bold">&times;</button>
                                <input type="hidden" :name="'game_systems[]'" :value="item[idKey]">
                            </div>
                        </template>
                    </div>

                    @error('game_systems')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Длительность игры -->
                <div>
                    <label for="game_duration" class="block text-lg font-bold text-gray-800 mb-1">Длительность игры:</label>
                    <select id="game_duration" name="game_duration"
                            class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="0">Ваншот (Одна игра)</option>
                        <option value="1">Кампания (Больше одной игры)</option>
                        <option value="2">Ваншот (Одна игра) с возможностью перейти в кампанию</option>
                    </select>
                    @error('game_duration')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Теги -->
                <div
                    x-data="multiSelect(@js($gameTags), 'game_style_tag_pk', 'game_style_tag')"
                    class="relative"
                >
                    <label for="game_tags" class="block text-lg font-bold text-gray-800 mb-1">Теги:</label>

                    <input type="text"
                           x-model="search"
                           @focus="open = true"
                           @keydown.escape="open = false"
                           placeholder="Начните вводить название тега..."
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    />

                    <div x-show="open"
                         @mousedown.away="open = false"
                         class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg"
                         style="min-width: 100%;"
                    >
                        <template x-for="item in filteredItems()" :key="item[`${idKey}`]">
                            <div @click="toggle(item)"
                                 :class="{'bg-blue-100': isSelected(item)}"
                                 class="cursor-pointer px-4 py-2 hover:bg-blue-200">
                                <span x-text="item[`${nameKey}`]"></span>
                            </div>
                        </template>
                        <div x-show="filteredItems().length === 0" class="px-4 py-2 text-gray-500">Теги не найдены</div>
                    </div>

                    <!-- Выбранные теги -->
                    <div class="mt-2 flex flex-wrap gap-2">
                        <template x-for="item in selected" :key="item[`${idKey}`]">
                            <div class="bg-blue-200 text-blue-800 px-3 py-1 rounded flex items-center space-x-2">
                                <span x-text="item[`${nameKey}`]"></span>
                                <button type="button" @click="remove(item)" class="font-bold">&times;</button>
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
                    <label for="description" class="block text-lg font-bold text-gray-800 mb-1">Описание:</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                              placeholder="Опишите вашу игру..."></textarea>
                    @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Город -->
                <div x-show="gameFormat != '1'" x-data="citySelect(@js($cityList))" class="relative">
                    <label for="city" class="block text-lg font-bold text-gray-800 mb-1">Город:</label>

                    <input id="city"
                           x-model="search"
                           @focus="open = true"
                           @keydown.escape="open = false"
                           @input="updateSelection"
                           type="text"
                           placeholder="Введите город проведения (Выберете 'Другой' если города нет в списке)"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           autocomplete="off"
                    />

                    <!-- Выпадающий список -->
                    <div x-show="open && filtered.length > 0"
                         @mousedown.away="open = false"
                         class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto shadow-lg w-full">
                        <template x-for="city in filtered" :key="city.city_pk">
                            <div @click="select(city)"
                                 class="cursor-pointer px-4 py-2 hover:bg-blue-200"
                                 :class="{ 'bg-blue-100': city.city === search }">
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
                <div>
                    <label for="game_place" class="block text-lg font-bold text-gray-800 mb-1">Место проведения игры:</label>
                    <input id="game_place" name="game_place"
                              class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                              placeholder="Адрес или место в онлайн формате где будет проводится игра"></input>
                    @error('game_place')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Дата проведения -->
                <div x-show="playerType === '0'">
                    <label for="date" class="block text-lg font-bold text-gray-800 mb-1">Дата проведения:</label>
                    <input id="date" name="date" type="date"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('date')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Время проведения -->
                <div x-show="playerType === '0'">
                    <label for="time" class="block text-lg font-bold text-gray-800 mb-1">Время проведения:</label>
                    <input id="time" name="time" type="time"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('time')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Цена -->
                <div x-show="playerType === '0'">
                    <label for="price" class="block text-lg font-bold text-gray-800 mb-1">Цена (₽):</label>
                    <input id="price" name="price" type="number" min="0" step="0.01"
                           class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Введите цену">
                    @error('price')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Список контактов -->
                <div>
                    <label for="contacts" class="block text-lg font-bold text-gray-800 mb-1">Контакты:</label>
                    <textarea id="contacts" name="contacts" rows="3"
                              class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"
                              placeholder="Телефон, email, Telegram и т.д."></textarea>
                    @error('contacts')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Нижняя кнопка -->
            <div class="bg-[#2D2D2D] px-6 py-4 flex justify-center space-x-4">
                <a href="/findGroup"
                        class="text-center bg-white text-black font-bold px-5 py-2 rounded hover:bg-gray-300 transition w-60">
                    Назад
                </a>
                <button type="submit"
                        class="text-center bg-white text-black font-bold px-5 py-2 rounded hover:bg-gray-300 transition w-60">
                    Сохранить изменения
                </button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        function multiSelect(data, idKey, nameKey) {
            return {
                open: false,
                search: '',
                selected: [],
                items: data,
                idKey: idKey,
                nameKey: nameKey,
                filteredItems() {
                    if (this.search === '') return this.items;
                    return this.items.filter(i =>
                        i[this.nameKey].toLowerCase().includes(this.search.toLowerCase())
                    );
                },
                toggle(item) {
                    if (this.isSelected(item)) {
                        this.selected = this.selected.filter(s => s[this.idKey] !== item[this.idKey]);
                    } else {
                        this.selected.push(item);
                    }
                },
                isSelected(item) {
                    return this.selected.some(s => s[this.idKey] === item[this.idKey]);
                },
                remove(item) {
                    this.selected = this.selected.filter(s => s[this.idKey] !== item[this.idKey]);
                }
            }
        }

        function citySelect(cities) {
            return {
                open: false,
                search: '',
                selected: null,
                cities: cities,
                get filtered() {
                    if (this.search === '') return [];
                    return this.cities.filter(c =>
                        c.city.toLowerCase().includes(this.search.toLowerCase())
                    );
                },
                select(city) {
                    this.search = city.city;
                    this.selected = city;
                    this.open = false;
                },
                updateSelection() {
                    if (!this.selected || this.search !== this.selected.city) {
                        this.selected = null;
                    }
                }
            }
        }
    </script>
@endsection
