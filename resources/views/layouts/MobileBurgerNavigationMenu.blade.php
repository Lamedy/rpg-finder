
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
                <a href="" class="p-2 rounded text-lg text-white bg-[#1a1a1a] text-center">Уведомления</a>
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

