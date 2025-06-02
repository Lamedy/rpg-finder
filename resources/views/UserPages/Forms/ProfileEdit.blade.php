@extends('layouts.MainContentPage')

@section('page_name', 'Профиль')

@section('content_title', 'Редактировать профиль:')

@section('content')
    <form action="{{ route('profile.edit.submit', $user) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="mx-auto rounded-md overflow-hidden shadow-lg border border-black bg-gray-200">
            <div class="p-4">
                <div class="flex justify-between items-start space-x-6 space-y-6">
                    <!-- Левая часть: аватар и имя -->
                    <div class="flex items-center space-x-3">
                        <input type="file" name="avatar" class="hidden" id="avatar">
                        <label for="avatar" class="relative inline-block">
                            <img
                                src="{{ asset('storage/' . ($user->avatar ?? 'default-avatar.png')) }}"
                                alt="Аватар"
                                class="w-32 h-32 rounded-full object-cover border-2 border-black shadow-md cursor-pointer"
                            />
                            <div class="absolute bottom-0 right-0 shadow-sm">
                                <img src="{{ asset('storage/icons/pencil2.svg') }}" class="w-7 h-7 cursor-pointer" />
                            </div>
                        </label>
                        <div class="relative w-full max-w-[70%]">
                            <input type="text" name="user_name" placeholder="Введите имя"
                                   class="w-full text-5xl px-2 font-alegreya_medium bg-transparent border-b border-black focus:outline-none pr-10"
                                   value="{{ old('user_name', $user->user_name) ?? '' }}">
                            <div class="absolute right-2 top-[60%] -translate-y-1/2 text-gray-600 pointer-events-none">
                                <img src="{{ asset('storage/icons/pencil.svg') }}" class="w-7 h-7" />
                            </div>
                        </div>

                    </div>
                    <!-- Правая часть: список -->
                    <div class="flex flex-col basis-1/3 space-y-2 font-alegreya_bold text-lg">
                        <!-- Пол -->
                        <div class="flex items-center space-x-2">
                            <span class="text-lg whitespace-nowrap">Пол: </span>
                            <select name="gender" class="w-full px-2 py-1 rounded-md border border-black bg-white hover:bg-gray-100">
                                <option value="0" {{ old('gender', $user->user_gender) == 0 ? 'selected' : '' }}>Женский</option>
                                <option value="1" {{ old('gender', $user->user_gender) == 1 ? 'selected' : '' }}>Мужской</option>
                            </select>
                        </div>
                        <!-- Дата рождения -->
                        <div class="flex items-center space-x-2">
                            <span class="text-lg whitespace-nowrap">Дата рождения:</span>
                            <input type="date" name="birthdate"
                                   class="w-full px-2 py-1 rounded-md border border-[#1a1a1a] bg-white hover:bg-gray-100"
                                   value="{{ old('birthdate', $user->birthdate) }}">
                        </div>
                        <!-- Город -->
                        <div
                             x-data="citySelect(@js($cityList), {{ $user->city_pk ?? null }} )"
                             x-init="init()"
                             class="flex items-center relative"
                        >
                            <span for="city" class="block mr-2 text-lg mb-1">Город:</span>

                            <input id="city"
                                   x-model="search"
                                   @focus="open = true"
                                   @keydown.escape="open = false"
                                   @input="updateSelection"
                                   type="text"
                                   placeholder="Начните ввод..."
                                   class="w-full px-2 py-1 rounded-md border border-[#1a1a1a] bg-white"
                                   autocomplete="off"
                            />

                            <!-- Выпадающий список -->
                            <div x-show="open && filtered.length > 0"
                                 @mousedown.away="open = false"
                                 class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto shadow-lg w-full top-full">
                                <template x-for="city in filtered" :key="city.city_pk">
                                    <div @click="select(city)"
                                         class="cursor-pointer px-4 py-2 hover:bg-gray-200"
                                         :class="{ 'bg-gray-100': city.city === search }">
                                        <span x-text="city.city"></span>
                                    </div>
                                </template>
                            </div>

                            <!-- Скрытое поле с ID выбранного города -->
                            <input type="hidden" name="city_id" :value="selected?.city_pk ?? ''">
                        </div>
                        @error('gender')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        @error('birthdate')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        @error('city_id')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @error('user_name')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                @error('avatar')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <!-- Роль -->
                <div class="flex items-center space-x-2 font-alegreya_bold text-2xl">
                    <span class="mb-1">Предпочитаю роль:</span>
                    <select name="role" class="max-w-[20%] px-2 rounded-md border border-black bg-white hover:bg-gray-100">
                        <option value="0" {{ old('role', $user->game_role) == 0 ? 'selected' : '' }} >Игрока</option>
                        <option value="1" {{ old('role', $user->game_role) == 1 ? 'selected' : '' }}>Мастера</option>
                        <option value="2" {{ old('role', $user->game_role) == 2 ? 'selected' : '' }}>Любую</option>
                    </select>
                </div>
                @error('role')
                <div class="text-red-500">{{ $message }}</div>
                @enderror

                <!-- Игровые системы -->
                <div x-data="gameSystemsComponent(@js($systems), @js($experiences), @js($user->gameSystemsList))">
                    <h2 class="text-2xl font-alegreya_bold mb-2">Знакомые мне игровые системы:</h2>

                    <div class="divide-y divide-[#1a1a1a] border border-[#1a1a1a] rounded-md overflow-visible bg-[#2D2D2D]">

                        <!-- Заголовки -->
                        <div class="grid grid-cols-[1fr_1fr_auto] bg-[#2D2D2D] font-alegreya_bold text-white text-lg">
                            <div class="px-4 py-2 border-r border-[#1a1a1a]">Игровая система</div>
                            <div class="px-4 py-2 border-r border-[#1a1a1a]">Игровой опыт</div>
                            <!-- Кнопка добавить -->
                            <div class="p-2">
                                <button
                                    type="button"
                                    @click="addRow()"
                                    class="bg-white w-[2.25rem] h-[2.25rem] text-4xl text-black hover:bg-gray-300 flex items-center justify-center rounded leading-none">
                                    +
                                </button>
                            </div>
                        </div>
                        <!-- Строки -->
                        <template x-for="(row, index) in rows" :key="row.id">
                            <div class="grid grid-cols-[1fr_1fr_auto] bg-white font-alegreya_bold text-lg items-center">
                                <!-- Игровая система -->
                                <div class="px-4 py-2 border-r border-[#1a1a1a] relative overflow-visible"
                                     x-data="singleSelect(@js($systems), 'game_system_pk', 'game_system_name', row.system)"
                                     x-init="init(selectedValue = row.system)">
                                    <input type="text"
                                           x-model="search"
                                           @click="open = true"
                                           @input="open = true"
                                           class="w-full px-2 py-1 border border-black rounded"
                                           placeholder="Выберите систему"
                                           >

                                    <ul x-show="open" @click.outside="open = false"
                                        class="absolute z-50 w-full bg-white border border-black rounded mt-1 max-h-40 overflow-y-auto"
                                        style="top: 100%; left: 0;">
                                        <template x-for="item in filteredItems()" :key="item.game_system_pk">
                                            <li @click="choose(item)"
                                                class="px-2 py-1 hover:bg-gray-200 cursor-pointer"
                                                x-text="item.game_system_name"></li>
                                        </template>
                                    </ul>
                                    <input type="hidden" :name="'systems[]'" :value="selected ? selected.game_system_pk : ''" x-model="row.system">
                                </div>

                                <!-- Игровой опыт -->
                                <div class="px-4 py-2 relative overflow-visible border-r border-[#1a1a1a]"
                                     x-data="singleSelect(@js($experiences), 'game_experience_pk', 'game_experience_description', row.experience)"
                                     x-init="init(selectedValue = row.experience)">
                                    <input type="text"
                                           x-model="search"
                                           @click="open = true"
                                           @input="open = true"
                                           class="w-full px-2 py-1 border border-black rounded"
                                           placeholder="Выберите опыт"
                                    >
                                    <ul x-show="open" @click.outside="open = false"
                                        class="absolute z-50 w-full bg-white border border-black rounded mt-1 max-h-40 overflow-y-auto"
                                        style="top: 100%; left: 0;">
                                        <template x-for="item in filteredItems()" :key="item.game_experience_pk">
                                            <li @click="choose(item)"
                                                class="px-2 py-1 hover:bg-gray-200 cursor-pointer"
                                                x-text="item.game_experience_description"></li>
                                        </template>
                                    </ul>
                                    <input type="hidden" :name="'experience[]'" :value="selected ? selected.game_experience_pk : ''" x-model="row.experience" >
                                </div>

                                <!-- Кнопка удалить -->
                                <div class="p-2">
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
                @error('systems')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                @error('experience')
                <div class="text-red-500">{{ $message }}</div>
                @enderror

                <!-- Теги -->
                <div
                    x-data="multiSelect(@js($gameTags), 'game_style_tag_pk', 'game_style_tag', @js($tags ?? null))"
                    x-init="init()"
                    class="relative"
                >
                    <label for="game_tags" class="text-2xl block mb-2 font-alegreya_bold mt-4 mb-1">Теги моих интересов:</label>

                    <div class="relative w-full">
                        <input type="text"
                               x-model="search"
                               @focus="open = true"
                               @keydown.escape="open = false"
                               placeholder="Начните вводить название тега..."
                               class="w-full px-4 py-2 rounded-md border border-[#1a1a1a] bg-white font-alegreya_bold"
                        />

                        <!-- Иконка внутри input -->
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 pointer-events-none">
                            <img src="{{ asset('storage/icons/search.svg') }}" class="w-5 h-5" />
                        </div>
                    </div>

                    <div x-show="open"
                         @mousedown.away="open = false"
                         class="absolute z-10 bg-white border border-gray-300 rounded mt-1 max-h-48 overflow-auto w-full shadow-lg font-alegreya_bold"
                         style="min-width: 100%;"
                    >
                        <template x-for="item in filteredItems()" :key="item[`${idKey}`]">
                            <div @click="toggle(item)"
                                 :class="{'bg-gray-300': isSelected(item)}"
                                 class="cursor-pointer px-4 py-2 hover:bg-gray-200">
                                <span x-text="item[`${nameKey}`]"></span>
                            </div>
                        </template>
                        <div x-show="filteredItems().length === 0" class="px-4 py-2 text-gray-500 font-alegreya_bold">Теги не найдены</div>
                    </div>

                    <!-- Выбранные теги -->
                    <div class="mt-2 flex flex-wrap gap-2">
                        <template x-for="item in selected" :key="item[`${idKey}`]">
                            <div class="bg-[#1a1a1a] text-white py-1 rounded flex items-center space-x-2">
                                <span class="pl-2 font-alegreya_bold" x-text="item[`${nameKey}`]"></span>
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

                <!-- Контактная информация -->
                <div x-data="contactMethodsComponent(@js($contactTypes), @js($user->userContactsList))" x-init="init()">
                    <h2 class="text-2xl font-alegreya_bold mt-4 mb-2">Контактная информация:</h2>

                    <div class="divide-y divide-[#1a1a1a] border border-[#1a1a1a] rounded-md overflow-visible bg-[#2D2D2D]">

                        <!-- Заголовки -->
                        <div class="grid grid-cols-[1fr_1fr_auto] bg-[#2D2D2D] font-alegreya_bold text-white text-lg">
                            <div class="px-4 py-2 border-r border-[#1a1a1a]">Тип контакта:</div>
                            <div class="px-4 py-2 border-r border-[#1a1a1a]">Контактные данные:</div>
                            <!-- Кнопка добавить -->
                            <div class="p-2">
                                <button
                                    type="button"
                                    @click="addRow()"
                                    class="bg-white w-[2.25rem] h-[2.25rem] text-4xl text-black hover:bg-gray-300 flex items-center justify-center rounded leading-none">
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Строки -->
                        <template x-for="(row, index) in rows" :key="row.id">
                            <div class="grid grid-cols-[1fr_1fr_auto] bg-white font-alegreya_bold text-lg items-center">

                                <!-- Тип контакта -->
                                <div class="px-4 py-2 border-r border-[#1a1a1a] relative overflow-visible"
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
                                <div class="px-4 py-2 border-r border-[#1a1a1a]">
                                    <input type="text"
                                           class="w-full px-2 py-1 border border-black rounded"
                                           placeholder="Введите данные"
                                           :name="'contact_values[]'"
                                           x-model="row.value"
                                           >
                                </div>

                                <!-- Кнопка удалить -->
                                <div class="p-2">
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
            <!-- Кнопки -->
            <div class="bg-[#2D2D2D] px-6 py-4 flex justify-center space-x-4 font-alegreya_bold">
                <a href="{{ route('profile', $user) }}"
                   class="text-center text-xl bg-white text-black font-alegreya_bold px-5 py-2 rounded hover:bg-[#ababab] transition w-60">
                    Назад
                </a>
                <button type="submit"
                        class="text-center text-xl bg-white text-black font-alegreya_bold px-5 py-2 rounded hover:bg-[#ababab] transition w-60">
                    Сохранить
                </button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function gameSystemsComponent(systemsData, experiencesData, initialData) {
            return {
                systems: systemsData,
                experiences: experiencesData,
                rows: [],

                init() {
                    this.rows = initialData.length
                        ? initialData.map(item => ({
                            id: Date.now() + Math.random(),
                            system: item.system.game_system_pk,
                            experience: item.experience.game_experience_pk,
                        }))
                        : [{
                            id: Date.now(),
                            system: '',
                            experience: ''
                        }];
                },

                addRow() {
                    this.rows.push({
                        id: Date.now() + Math.random(),
                        system: '',
                        experience: ''
                    });
                },

                removeRow(index) {
                    if (this.rows.length > 1) {
                        this.rows.splice(index, 1);
                    } else {
                        this.rows[0] = { id: Date.now(), system: '', experience: '' };
                    }
                },
            }
        }

        function contactMethodsComponent(contactTypes, initialData) {
            return {
                types: contactTypes,
                rows: [],

                init() {
                    this.rows = initialData.length
                        ? initialData.map(item => ({
                            id: Date.now() + Math.random(),
                            type: item.contact_methods_pk,
                            value: item.contact_value
                        }))
                        : [{
                            id: Date.now(),
                            type: '',
                            value: ''
                        }];
                },

                addRow() {
                    this.rows.push({
                        id: Date.now() + Math.random(),
                        type: '',
                        value: ''
                    });
                },

                removeRow(index) {
                    if (this.rows.length > 1) {
                        this.rows.splice(index, 1);
                    } else {
                        this.rows[0] = { id: Date.now(), type: '', value: '' };
                    }
                },
            }
        }
    </script>
@endsection

