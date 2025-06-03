<div
    x-show="$store.ui.openFilters"
    x-transition:enter="transition ease-in-out duration-300"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="fixed top-0 bottom-0 right-0 w-full min-w-80 bg-[#262626] shadow-lg z-50 flex flex-col lg:hidden"
    @click.away="$store.ui.openFilters = false"
    style="display: none"
>
    <!-- Вся область, которая может прокручиваться -->
    <div class="flex-1 overflow-y-auto no-shadow">
        <div class="px-2">
            <div class="relative flex items-center gap-4 p-4 border-b border-white">
                <button
                    @click="$store.ui.openFilters = !$store.ui.openFilters"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white text-black shadow-md"
                    aria-label="Назад"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <span class="absolute left-1/2 transform -translate-x-1/2 text-white text-2xl select-none pointer-events-none">
                    Фильтры поиска
                </span>
            </div>

            <div class="max-w-150 m-auto">
                @include('Components.SearchFilters')
            </div>
        </div>
    </div>
</div>

