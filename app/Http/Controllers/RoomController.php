<?php

namespace App\Http\Controllers;

use App\Email\NewNotification;
use App\Models\GameSession;
use App\Models\NoticeList;
use App\Models\PlayerListOfGameSession;
use App\Models\User;
use App\Models\UserAuthorization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function show(GameSession $room): View
    {
        if (Auth::check()) {
            $userId = Auth::user()->user_pk;
            $room->playerInviteForCurrentUser = $room->playerInviteForUser($userId)->first();
        }

        $room->load(['userList.user', 'userList.noticeForAuthor']);

        return view('Room', compact('room'));
    }
    public function join(GameSession $room): JsonResponse
    {
        $userListInRoom = PlayerListOfGameSession::select('user_pk')->where('game_session_pk', $room->game_session_pk)->get();

        foreach ($userListInRoom as $user) {
            if ($user->user_pk == Auth::user()->user_pk) {
                return response()->json([
                    'message' => 'Вы уже есть в этой комнате'
                ]);
            }
        }

        DB::beginTransaction();

        try {
            $notice = NoticeList::create([
                'from_user' => Auth::user()->user_pk,
                'for_user' => $room->author,
                'notice_type' => 0, // 0 - Запрос на вступление в комнату
            ]);

            PlayerListOfGameSession::create([
                'user_pk' => Auth::user()->user_pk,
                'game_session_pk' => $room->game_session_pk,
                'notice_for_author' => $notice->notice_list_pk,
            ]);

            DB::commit();

            Mail::to($room->user->auth->email)->send(new NewNotification(
                $room->user,
                Auth::user(),
            ));

            return response()->json([
                'message' => 'Статус приглашения: Рассматривается'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Что-то пошло не так :('
            ]);
        }
    }

    public function notAcceptInvite(GameSession $room, NoticeList $notice): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $playerListOfGameSession = PlayerListOfGameSession::where('notice_for_author', $notice->notice_list_pk)->first();

            $noticeAnswer = NoticeList::create([
                'from_user' => $room->author ,
                'for_user' => $notice->from_user,
                'notice_type' => 1, // 1 - Ответ на запрос на вступление в комнату
                'answer' => 'отклонил вашу заявку'
            ]);

            $notice->update(['answer' => 'Вы отклонили заявку']);

            $playerListOfGameSession->update([
                'invite_status' => 2,
                'notice_for_user' => $noticeAnswer->notice_list_pk
            ]);

            DB::commit();

            $user = User::where('user_pk', $notice->from_user)->first();

            Mail::to($user->auth->email)->send(new NewNotification(
                $user,
                Auth::user(),
            ));

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function acceptInvite(GameSession $room, NoticeList $notice): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $playerListOfGameSession = PlayerListOfGameSession::where('notice_for_author', $notice->notice_list_pk)->first();

            $noticeAnswer = NoticeList::create([
                'from_user' => $room->author ,
                'for_user' => $notice->from_user,
                'notice_type' => 1, // 1 - Ответ на запрос на вступление в комнату
                'answer' => 'принял вашу заявку'
            ]);

            $notice->update(['answer' => 'Вы приняли заявку']);

            $playerListOfGameSession->update([
                'invite_status' => 1,
                'notice_for_user' => $noticeAnswer->notice_list_pk
            ]);

            DB::commit();

            $user = User::where('user_pk', $notice->from_user)->first();

            Mail::to($user->auth->email)->send(new NewNotification(
                $user,
                Auth::user(),
            ));

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
