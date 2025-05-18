<?php

namespace App\Http\Controllers\Forms\User;

use App\Models\Sessions;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Settings extends Controller
{
    public function show(): View
    {
        return view('UserPages.Settings')->with(
            [
                'show_contacts_other' => User::getValueShowContactsOther(Auth::id()),
                'sessions_list' => Sessions::getUserSessionsList(Auth::id())
            ]
        );
    }

    public function submit(Request $request): RedirectResponse
    {
        $userId = Auth::id();

        if ($request->has('deleted_sessions')) {
            $deleted = json_decode($request->input('deleted_sessions'), true);

            if (is_array($deleted) && count($deleted)) {
                Sessions::deletedSessions($deleted);
            }
        }

        if (Sessions::isUserHaveSessions($userId)) {
            return redirect()->back();
        }

        return redirect()->route('main');
    }
}
