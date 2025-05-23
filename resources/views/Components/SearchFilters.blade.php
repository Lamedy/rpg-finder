<div class="bg-[#2D2D2D] p-4"
     x-data="{
            rating: false,
            system: false,
            format: false,
            role: false,
            duration: false,
            tags: false
        }"
>
    <h2 class="text-2xl font-alegreya_medium mb-4 border-b border-white pb-2">Фильтры поиска:</h2>

    {{-- Цена --}}
    <div>
        <label class="block font-semibold">Цена:</label>
        <div class="flex space-x-2">
            <input type="number" placeholder="от: 0" class="w-1/2 px-2 py-1 rounded bg-white border" />
            <input type="number" placeholder="до: 99999" class="w-1/2 px-2 py-1 rounded bg-white border" />
        </div>
    </div>

    {{-- Рейтинг больше 4 --}}
    <div>
        <label class="inline-flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" class="form-checkbox" />
            <span>Рейтинг больше 4</span>
        </label>
    </div>

    {{-- Игровая система --}}
    <div>
        <button @click="system = !system" class="flex items-center font-semibold w-full">
            <span>▼</span><span class="ml-2">Игровая система</span>
        </button>
        <div x-show="system" class="mt-2 pl-4 space-y-1">
            <label><input type="checkbox" class="mr-1"> DnD</label>
            <label><input type="checkbox" class="mr-1"> Pathfinder</label>
        </div>
    </div>

    {{-- Формат игры --}}
    <div>
        <button @click="format = !format" class="flex items-center font-semibold w-full">
            <span>▼</span><span class="ml-2">Формат игры</span>
        </button>
        <div x-show="format" class="mt-2 pl-4 space-y-1">
            <label><input type="checkbox" class="mr-1"> Онлайн</label>
            <label><input type="checkbox" class="mr-1"> Оффлайн</label>
        </div>
    </div>

    {{-- Роль в игре --}}
    <div>
        <button @click="role = !role" class="flex items-center font-semibold w-full">
            <span>▼</span><span class="ml-2">Роль в игре</span>
        </button>
        <div x-show="role" class="mt-2 pl-4 space-y-1">
            <label><input type="checkbox" class="mr-1"> Ведущий</label>
            <label><input type="checkbox" class="mr-1"> Игрок</label>
        </div>
    </div>

    {{-- Город --}}
    <div>
        <label class="block font-semibold">Город:</label>
        <select class="w-full px-2 py-1 rounded bg-white border">
            <option>Москва</option>
            <option>Санкт-Петербург</option>
        </select>
    </div>

    {{-- Длительность игры --}}
    <div>
        <button @click="duration = !duration" class="flex items-center font-semibold w-full">
            <span>▼</span><span class="ml-2">Длительность игры</span>
        </button>
        <div x-show="duration" class="mt-2 pl-4 space-y-1">
            <label><input type="checkbox" class="mr-1"> До 3 часов</label>
            <label><input type="checkbox" class="mr-1"> Более 3 часов</label>
        </div>
    </div>

    {{-- Игровой опыт --}}
    <div>
        <label class="block font-semibold">Игровой опыт:</label>
        <div class="flex space-x-2">
            <input type="number" placeholder="от: 0" class="w-1/2 px-2 py-1 rounded bg-white border" />
            <input type="number" placeholder="до: 100" class="w-1/2 px-2 py-1 rounded bg-white border" />
        </div>
    </div>

    {{-- Теги --}}
    <div>
        <button @click="tags = !tags" class="flex items-center font-semibold w-full">
            <span>▼</span><span class="ml-2">Теги</span>
        </button>
        <div x-show="tags" class="mt-2 pl-4 space-y-1">
            <label><input type="checkbox" class="mr-1"> Мистика</label>
            <label><input type="checkbox" class="mr-1"> Экшен</label>
            <label><input type="checkbox" class="mr-1"> Хоррор</label>
        </div>
    </div>

</div>

