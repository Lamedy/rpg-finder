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
                'playerSession.gameSession'
            ])
            ->get();
        return view('UserPages.Notifications', compact('notifications'));
    }
}
