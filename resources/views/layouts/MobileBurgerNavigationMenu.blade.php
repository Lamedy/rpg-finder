
<div
    x-show="$store.ui.openMenu"
    x-transition:enter="transition ease-in-out duration-300"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
    class="fixed top-13 bottom-0 right-0 w-full min-w-80 bg-[#262626] shadow-lg z-50 flex flex-col lg:hidden overflow-y-auto"
    @click.away="$store.ui.openMenu = false"
    style="display: none"
>
    <!-- Навигация -->
    <div class="p-4 font-alegreya_medium text-white">
        <h2 class="text-shadow text-2xl border-b border-white pb-2 max-w-100 mx-auto">Навигация:</h2>
        <ul class="space-y-2 mt-2 text-xl max-w-100 mx-auto">
            <li><a href="/" class="block px-3 py-2 rounded bg-[#1a1a1a] text-center">Главная</a></li>
            <li><a href="/findGroup" class="block px-3 py-2 rounded bg-[#1a1a1a] text-center">Поиск компании</a></li>
        </ul>
    </div>

    <div class="p-4 font-alegreya_medium text-white">
        <h2 class="text-shadow text-2xl border-b border-white pb-2 max-w-100 mx-auto">Аккаунт:</h2>

            <nav class="flex flex-col space-y-1 py-1 font-alegreya_medium max-w-100 mx-auto">
                @if (Auth::check())
                    <a href="{{ route('account.notifications') }}"
                       class="group relative inline-flex items-center justify-center gap-2 p-2 rounded text-lg text-white bg-[#1a1a1a] w-full h-full">

                        <span class="leading-none">Уведомления</span>

                        <div class="relative flex items-center">
                            <svg class="w-6 h-6 text-white transition-colors duration-200"
                                 fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>

                            @if($unreadNoticesCount > 0)
                                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                    {{ $unreadNoticesCount }}
                                </span>
                            @endif
                        </div>
                    </a>
                <a href="{{ route('account.my_advertisements') }}" class="p-2 rounded text-lg text-white bg-[#1a1a1a] text-center">Мои анкеты</a>
                <a href="{{ route('profile', Auth::user()) }}" class="p-2 rounded text-lg text-white bg-[#1a1a1a] text-center">Профиль</a>
                <a href="/account/settings" class="p-2 rounded text-lg text-white bg-[#1a1a1a] text-center">Настройки</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full p-2 rounded text-lg text-white bg-[#1a1a1a] cursor-pointer text-center">Выйти из аккаунта</button>
                </form>
                @else
                    <a href="/login" class="p-2 rounded text-xl text-white bg-[#1a1a1a] text-center font-alegreya_medium">
                        Вход
                    </a>
                @endif
            </nav>
    </div>
</div>

