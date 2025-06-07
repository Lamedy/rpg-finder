<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\NoticeList;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Notifications extends Controller
{
    public function show(): View
    {
        $notifications = NoticeList::where('for_user', Auth::user()->user_pk)
            ->with([
                'sender',
                'playerSessionAuthor.gameSession',
                'playerSessionUser.gameSession'
            ])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $idsOnPage = $notifications->pluck('notice_list_pk')->toArray();

        NoticeList::whereIn('notice_list_pk', $idsOnPage)
            ->where('read_status', false)
            ->update(['read_status' => true]);

        return view('UserPages.Notifications', compact('notifications'));
    }
}
