@extends('layouts.MainContentPage')

@section('page_name', 'Настройки')

@section('content_title', 'Настройки аккаунта:')

@section('content')
    <form id="settings-form" method="POST" action="{{ route('account.settings.update') }}">
        @csrf
        <div class="max-w-2xl mx-auto rounded-md overflow-hidden shadow-lg border border-black bg-gray-200">
            <div class="p-4 space-y-4">
                <!-- Видимость контактов -->
                <div class="font-alegreya_medium">
                    <label for="visibility" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Кто может видеть мои контактные данные:</label>
                    <select id="visibility" name="visibility"
                            class="w-full px-4 py-2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="0" {{ $show_contacts_other == 0 ? 'selected' : '' }}>Те, кому я разрешу</option>
                        <option value="1" {{ $show_contacts_other == 1 ? 'selected' : '' }}>Все</option>
                    </select>
                </div>

                <!-- Сброс пароля -->
                <div class="flex justify-between items-center">
                    <label for="reset_password" class="block text-lg font-alegreya_bold text-gray-800 mb-1">Пароль:</label>
                    <a href="/account/settings/change_password"
                            class="bg-[#2D2D2D] text-white px-4 py-2 font-alegreya_medium rounded hover:bg-[#444] transition">
                        Изменить пароль
                    </a>
                </div>

                <!-- Сессии -->
                <input type="hidden" name="deleted_sessions" id="deleted_sessions" value="[]">
                <div>
                    <label class="block text-lg font-alegreya_bold text-gray-800 mb-1">Текущие сессии:</label>
                    <div id="sessions-list" class="bg-gray-100 border border-gray-400 rounded-md p-2 space-y-2">
                        @foreach($sessions_list as $session)
                            <div class="flex justify-between items-center bg-white px-3 py-1 rounded shadow session-item" data-session-id="{{ $session['id'] }}">
                                <span class="font-semibold text-sm">
                                    IP: {{ $session['ip_address'] }} — {{ $session['user_agent'] }}<br>
                                    Последняя активность: {{ date('d.m.Y H:i:s', $session['last_activity']) }}
                                </span>
                                <button type="button" class="icon-trash delete-session">
                                    <img src="{{ asset('storage/icons/trash.svg') }}" alt="trash icon" />
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Удалить все сессии -->
                <div class="text-right">
                    <button type="button" id="delete-all-sessions"
                            class="bg-[#2D2D2D] text-white px-5 py-2 font-alegreya_medium rounded hover:bg-[#444] transition">
                        Удалить все сессии
                    </button>
                </div>
            </div>
        <!-- Нижняя кнопка -->
        <div class="bg-[#2D2D2D] px-6 py-4 flex justify-center">
            <button type="submit" form="settings-form"
                    class="bg-white text-black font-alegreya_bold px-5 py-2 rounded hover:bg-gray-300 transition">
                Сохранить изменения
            </button>
        </div>
    </div>
    </form>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deletedSessionsInput = document.getElementById('deleted_sessions');
            const deletedSessions = [];

            // Удаление одной сессии
            document.querySelectorAll('.delete-session').forEach(button => {
                button.addEventListener('click', function () {
                    const sessionItem = this.closest('.session-item');
                    const sessionId = sessionItem.getAttribute('data-session-id');
                    if (sessionId) {
                        deletedSessions.push(sessionId);
                        deletedSessionsInput.value = JSON.stringify(deletedSessions);
                    }

                    sessionItem.remove();
                });
            });

            // Удаление всех сессий
            document.getElementById('delete-all-sessions')?.addEventListener('click', function () {
                const sessionItems = document.querySelectorAll('.session-item');

                sessionItems.forEach(item => {
                    const sessionId = item.getAttribute('data-session-id');
                    if (sessionId) {
                        deletedSessions.push(sessionId);
                    }

                    item.remove();
                });

                deletedSessionsInput.value = JSON.stringify(deletedSessions);
            });
        });
    </script>
@endsection
