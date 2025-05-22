<?php

namespace App\Http\Controllers;

use App\Models\GameSession;
use Illuminate\View\View;

class FindGroup extends Controller
{
    public function show(): View
    {
        $countCardsOnOnePage = 5;

        $games = GameSession::with(['gameSystems.system', 'city', 'tags.tag', 'user'])
            ->paginate($countCardsOnOnePage);

        return view('FindGroup')->with(['games' => $games]);
    }
}
