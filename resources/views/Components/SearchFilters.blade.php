<form method="GET" action="{{ route('find.group') }}">
    <div class="lg:bg-[#2D2D2D] p-4 font-alegreya_medium"
         x-data="{
             format: @json(request()->has('format') ? (bool)request()->get('format') : false),
             role: @json(request()->has('role') ? (bool)request()->get('role') : false),
             system: @json(request()->has('system') ? (bool)request()->get('system') : false),
             duration: @json(request()->has('duration') ? (bool)request()->get('duration') : false),
             tags: @json(request()->has('tags') ? (bool)request()->get('tags') : false)
         }"
    >
        <h2 class="text-2xl font-alegreya_medium mb-2 border-b border-white pb-2 text-shadow lg:static lg:block hidden">Фильтры поиска:</h2>

        <!-- Город -->
        <div x-data="citySelect(@js($cityList), {{ $city_id ?? 'null' }})" x-init="init()" class="relative">
            <label for="city" class="block py-1">Город:</label>

            <input id="city"
                   x-model="search"
                   @click="open = true"
                   @input="open = true"
                   @input="updateSelection"
                   type="text"
                   placeholder="Начните ввод..."
                   class="w-full px-2 py-2 rounded bg-white border text-black"
                   autocomplete="off"
            />

            <!-- Выпадающий список -->
            <div x-show="open && filtered.length > 0"
                 @click.outside="open = false"
                 class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto shadow-lg w-full text-black">
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
        </div>

        {{-- Цена --}}
        <div class="mb-2">
            <label class="block  py-1">Цена:</label>
            <div class="flex space-x-2">
                <input
                    type="number"
                    name="price_min"
                    placeholder="от: 0"
                    class="w-1/2 px-2 py-1 rounded bg-white border text-black"
                    value="{{ request('price_min') }}"
                    min="0"
                    max="100000"
                />
                <input
                    type="number"
                    name="price_max"
                    placeholder="до: 100000"
                    class="w-1/2 px-2 py-2 rounded bg-white border text-black"
                    value="{{ request('price_max') }}"
                    min="0"
                    max="100000"
                />
            </div>
        </div>

        {{-- Формат игры --}}
        <div>
            <input type="hidden" name="format" :value="format ? '1' : '0'">
            <button type="button"
                    @click="format = !format"
                    class="flex items-center  w-full p-1 rounded text-white bg-[#262626] hover:bg-[#1a1a1a] transition"
            >
                <span x-text="format ? '▲' : '▼'"></span>
                <span class="ml-2">Формат игры</span>
            </button>
            <div x-show="format" class="mt-2 pl-4">
                <div class="flex w-full space-x-4">
                    <div class="w-1/2">
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="game_format[]"
                                   value="1"
                                   class="mr-2" {{ in_array('1', (array) request()->get('game_format', [])) ? 'checked' : '' }}>
                            <span>Онлайн</span>
                        </label>
                    </div>
                    <div class="w-1/2">
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="game_format[]"
                                   value="0"
                                   class="mr-2" {{ in_array('0', (array) request()->get('game_format', [])) ? 'checked' : '' }}>
                            <span>Вживую</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Роль в игре --}}
        <div class="py-2">
            <input type="hidden" name="role" :value="role ? '1' : '0'">
            <button type="button"
                    @click="role = !role"
                    class="flex items-center  w-full p-1 rounded text-white bg-[#262626] hover:bg-[#1a1a1a] transition"
            >
                <span x-text="role ? '▲' : '▼'"></span>
                <span class="ml-2">Моя роль в игре</span>
            </button>
            <div x-show="role" class="mt-2 pl-4">
                <div class="flex w-full space-x-4">
                    <div class="w-1/2">
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="my_game_role[]"
                                   value="1"
                                   class="mr-2" {{ in_array('1', (array) request()->get('my_game_role', [])) ? 'checked' : '' }}>
                            <span>Игрок</span>
                        </label>
                    </div>
                    <div class="w-1/2">
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="my_game_role[]"
                                   value="0"
                                   class="mr-2" {{ in_array('0', (array) request()->get('my_game_role', [])) ? 'checked' : '' }}>
                            <span>Мастер</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Длительность игры --}}
        <div>
            <input type="hidden" name="duration" :value="duration ? '1' : '0'">
            <button type="button"
                    @click="duration = !duration"
                    class="flex items-center  w-full p-1 rounded text-white bg-[#262626] hover:bg-[#1a1a1a] transition"
            >
                <span x-text="duration ? '▲' : '▼'"></span>
                <span class="ml-2">Длительность игры</span>
            </button>
            <div x-show="duration" class="mt-2 pl-4">
                <div class="flex w-full space-x-4">
                    <div class="w-1/2">
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="game_duration[]"
                                   value="0"
                                   class="mr-2" {{ in_array('0', (array) request()->get('game_duration', [])) ? 'checked' : '' }}>
                            <span>Одна игра</span>
                        </label>
                    </div>
                    <div class="w-1/2">
                        <label class="flex items-center">
                            <input type="checkbox"
                                   name="game_duration[]"
                                   value="1"
                                   class="mr-2" {{ in_array('1', (array) request()->get('game_duration', [])) ? 'checked' : '' }}>
                            <span>Кампания</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Выбор систем -->
        <div
            x-data="multiSelect(@js($gameSystems), 'game_system_pk', 'game_system_name', @js(request('game_systems')))"
            x-init="init()"
            class="relative mt-2"
        >
            <label for="game_systems" class="block  py-1">Игровые системы:</label>

            <input type="text"
                   x-model="search"
                   @click="open = true"
                   @input="open = true"
                   placeholder="Выберите системы..."
                   class="w-full px-2 py-2 rounded bg-white border text-black"
            />

            <div x-show="open"
                 @click.outside="open = false"
                 class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg"
                 style="min-width: 100%;"
            >
                <template x-for="item in filteredItems()" :key="item[idKey]">
                    <div @click="toggle(item)"
                         :class="{'bg-gray-300': isSelected(item)}"
                         class="cursor-pointer px-4 py-2 hover:bg-gray-200 text-black">
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
                                class="font-bold flex items-center justify-center w-5 h-5 hover:bg-[#262626]">&times;
                        </button>
                        <input type="hidden" :name="'game_systems[]'" :value="item[idKey]">
                    </div>
                </template>
            </div>
        </div>

        <!-- Теги -->
        <div
            x-data="multiSelect(@js($gameTags), 'game_style_tag_pk', 'game_style_tag', @js(request('game_tags')))"
            x-init="init()"
            class="relative"
        >
            <label for="game_tags" class="block  py-1">Теги:</label>

            <input type="text"
                   x-model="search"
                   @click="open = true"
                   @input="open = true"
                   placeholder="Выберите теги..."
                   class="w-full px-2 py-2 rounded bg-white border text-black"
            />

            <div x-show="open"
                 @click.outside="open = false"
                 class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg"
                 style="min-width: 100%;"
            >
                <template x-for="item in filteredItems()" :key="item[`${idKey}`]">
                    <div @click="toggle(item)"
                         :class="{'bg-gray-300': isSelected(item)}"
                         class="cursor-pointer px-4 py-2 hover:bg-gray-200 text-black">
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
                                class="font-bold flex items-center justify-center w-5 h-5 hover:bg-[#262626]">&times;
                        </button>
                        <input type="hidden" :name="'game_tags[]'" :value="item[`${idKey}`]">
                    </div>
                </template>
            </div>
        </div>

        <br>
        <a href="{{ route('find.group', ['load_city' => false, 'page' => request()->get('page', 1)]) }}"
           class="block w-full text-center bg-white text-[#a30d0d] font-bold px-5 py-2 rounded hover:bg-[#ababab] mb-2">
            Сбросить фильтры
        </a>
        <input type="hidden" value="0" name="load_city">
        <button type="submit"
                class="block w-full text-center bg-white text-black font-bold px-5 py-2 rounded hover:bg-[#ababab] cursor-pointer">
            Применить фильтры
        </button>
    </div>
</form>
