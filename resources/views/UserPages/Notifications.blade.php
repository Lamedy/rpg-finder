@extends('layouts.MainContentPage')

@section('page_name', 'Уведомления')

@section('content_title', 'Уведомления:')

@section('content')
    <!-- Список новостей -->
    @forelse ($notifications as $notice)
        @if ( $notice['notice_type'] == 0)
            <div class="bg-gray-200 rounded shadow border border-black font-alegreya_medium text-xl">
                <p class="p-2 break-words">
                    Пользователь
                    <a href="{{ route('profile', $notice->sender) }}"
                       class="inline-block bg-gray-300 hover:bg-[#1a1a1a] hover:text-white px-3 rounded">
                        {{ $notice->sender->user_name ?? 'Неизвестно' }}
                    </a>
                    желает вступить в вашу
                    <a href="{{ route('room', $notice->playerSessionAuthor->gameSession) }}"
                       class="inline-block bg-gray-300 hover:bg-[#1a1a1a] hover:text-white px-3 rounded">
                        команду.
                    </a>
                    Вы согласны?
                </p>

                @if($notice['answer'] != null)
                    <p class="break-words p-2">
                        Ваш ответ: {{ $notice['answer'] }}
                    </p>
                @else
                <div class="flex flex-wrap justify-start px-2 gap-2 flex-1 min-w-[200px] mb-2">
                    <form class="w-full sm:w-auto" action="{{ route('not_accept_invite', ['room' => $notice->playerSessionAuthor->gameSession, 'notice' => $notice]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                                class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-2 py-1 transition text-base sm:text-lg w-full sm:w-60">
                            Нет
                        </button>
                    </form>
                    <form class="w-full sm:w-auto" action="{{ route('accept_invite', ['room' => $notice->playerSessionAuthor->gameSession, 'notice' => $notice]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                                class="bg-[#2D2D2D] hover:bg-[#1a1a1a] text-white text-center rounded px-2 py-1 transition text-base sm:text-lg w-full sm:w-60">
                            Да
                        </button>
                    </form>
                </div>
                @endif
                <div class="bg-[#3A3A3A] text-white text-xl px-2 py-1 rounded border">
                    {{ \Carbon\Carbon::parse($notice['updated_at'])->format('Дата: d.m.Y Время: H:i') }}
                </div>
            </div>
        @elseif($notice['notice_type'] == 1)
            <div class="bg-gray-200 rounded shadow border border-black font-alegreya_medium text-xl">
                <p class="p-2 break-words">Пользователь
                    <a href="{{ route('profile', $notice->sender) }}"  class="inline-block bg-gray-300 hover:bg-[#1a1a1a] hover:text-white px-3 rounded">
                        {{ $notice->sender->user_name ?? 'Неизвестно' }}
                    </a>
                    {{ $notice['answer'] }} в
                    <a href="{{ route('room', $notice->playerSessionUser->gameSession) }}"
                       class="inline-block bg-gray-300 hover:bg-[#1a1a1a] hover:text-white px-3 rounded">
                        команду.
                    </a>
                </p>

                <div class="bg-[#3A3A3A] text-white text-xl px-2 py-1 rounded border">
                    {{ \Carbon\Carbon::parse($notice['updated_at'])->format('Дата: d.m.Y Время: H:i') }}
                </div>
            </div>
        @endif
        <br>
    @empty
        <div
            class="bg-gray-200 text-4xl py-4 font-alegreya_bold text-center rounded-lg border border-gray-400 shadow-md">
            Здесь пока нет сообщений для вас.
        </div>
    @endforelse
    {{ $notifications->links('pagination::tailwind') }}
@endsection
