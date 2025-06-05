<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use App\Models\NoticeList;
use App\Models\PlayerListOfGameSession;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
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
                'notice_list_pk' => $notice->notice_list_pk,
            ]);

            DB::commit();
            return response()->json([
                'message' => 'Статус приглашения: Расматривается'
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
            $playerListOfGameSession = PlayerListOfGameSession::where('notice_list_pk', $notice->notice_list_pk)->first();

            NoticeList::create([
                'from_user' => $room->author ,
                'for_user' => $notice->from_user,
                'notice_type' => 1, // 1 - Ответ на запрос на вступление в комнату
                'answer' => 'отклонил вашу заявку'
            ]);

            $notice->update(['answer' => 'Вы отклонили заявку']);

            $playerListOfGameSession->update([
                'invite_status' => 2,
            ]);

            DB::commit();
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
            $playerListOfGameSession = PlayerListOfGameSession::where('notice_list_pk', $notice->notice_list_pk)->first();

            NoticeList::create([
                'from_user' => $room->author ,
                'for_user' => $notice->from_user,
                'notice_type' => 1, // 1 - Ответ на запрос на вступление в комнату
                'answer' => 'принял вашу заявку'
            ]);

            $notice->update(['answer' => 'Вы приняли заявку']);

            $playerListOfGameSession->update([
                'invite_status' => 1,
            ]);

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
