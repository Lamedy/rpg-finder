<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use Illuminate\View\View;

class FindGroup extends Controller
{
    public function show(): View
    {
        $countCardsOnOnePage = 5;
        $page = 0;

        $games = GameSession::with(['gameSystems.system', 'city', 'tags.tag', 'user'])
            ->skip($countCardsOnOnePage * $page)
            ->limit($countCardsOnOnePage)
            ->get();

        return view('FindGroup')->with(['games' => $games]);
    }
}
