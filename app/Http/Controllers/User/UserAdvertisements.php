<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GameSession;
use Illuminate\View\View;

class UserAdvertisements extends Controller
{
    public function show(): View
    {
        $countCardsOnOnePage = 5;

        $games = GameSession::with(['gameSystems.system', 'city', 'tags.tag', 'user'])
            ->orderBy('created_at', 'desc')
            ->where('author', auth()->id())
            ->paginate($countCardsOnOnePage);

        return view('UserPages.UserAdvertisements')->with(['games' => $games]);
    }
}
