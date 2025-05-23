<?php

namespace App\Http\Controllers\User\Forms;

use App\Http\Controllers\Controller;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class Settings extends Controller
{
    public function show(): View
    {
        $userId = Auth::id();
        $showContactsOthers = User::getValueShowContactsOther($userId);

        Cookie::queue('prev_show_contacts_other', $showContactsOthers, 60);

        return view('UserPages.Forms.Settings')->with(
            [
                'show_contacts_other' => $showContactsOthers,
                'sessions_list' => Sessions::getUserSessionsList($userId)
            ]
        );
    }

    public function submit(Request $request): RedirectResponse
    {
        $userId = Auth::id();

        $newValueShowContactsOthers = $request->input('visibility');
        $oldValueShowContactsOthers = Cookie::get('prev_show_contacts_other');

        if ($oldValueShowContactsOthers !== null && $newValueShowContactsOthers != $oldValueShowContactsOthers) {
            $user = Auth::user();
            $user->show_contacts_others = $newValueShowContactsOthers;
            $user->save();
        }

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
