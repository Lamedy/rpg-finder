<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\GameSession;
use App\Models\GameSessionSystemList;
use App\Models\GameSystems;
use App\Models\GameStyleTag;
use App\Models\SessionTagsList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CreateCard extends Controller
{
    public function show(): View
    {
        return view('Forms.CreateCard')
            ->with([
                'gameSystems' => GameSystems::select('game_system_pk', 'game_system_name')->get(),
                'gameTags' => GameStyleTag::select('game_style_tag_pk', 'game_style_tag')->get(),
                'cityList' => City::select('city_pk', 'city')->get(),
            ]);
    }

    public function submit(Request $request ): RedirectResponse
    {
        $validator = $request->validate([
            'player_type'   => 'required|in:0,1',
            'player_count'  => 'required_if:player_type,0|nullable|integer|min:1',
            'game_format'   => 'required|in:0,1,2',
            'game_systems'  => 'required|array|min:1',
            'game_systems.*'=> 'integer|exists:game_system,game_system_pk',
            'game_duration' => 'required|in:0,1,2',
            'game_tags'     => 'nullable|array',
            'game_tags.*'   => 'integer|exists:game_style_tag,game_style_tag_pk',
            'description'   => 'nullable|string|max:1000',
            'city_id'       => 'required_unless:game_format,1|nullable|integer|exists:city,city_pk',
            'game_place'    => 'nullable|string|max:255',
            'date'          => 'nullable|date|after_or_equal:today|required_with:time',
            'time'          => 'nullable|date_format:H:i',
            'price'         => 'nullable|numeric|min:0',
            'contacts'      => 'required|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $date = $request->input('date');
            $time = $request->input('time');
            $datetime = null;

            if ($date && $time) {
                $datetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "$date $time");
            } elseif ($date) {
                $datetime = $date;
            }

            $gameSession = GameSession::create([
                'player_type_needed' => $request->get('player_type'),
                'player_count' => $request->get('player_count'),
                'game_format' => $request->get('game_format'),
                'game_duration' => $request->get('game_duration'),
                'game_description' => $request->get('description'),
                'game_place' => $request->get('game_place'),
                'game_date' => $datetime,
                'author' => Auth::user()->user_pk,
                'city_pk' => $request->get('city_id'),
                'price' => $request->get('price'),
                'contacts' => $request->get('contacts'),
            ]);

            foreach ($request->get('game_systems') as $game_system => $game_system_pk) {
                GameSessionSystemList::create([
                    'game_session_pk' => $gameSession->game_session_pk,
                    'game_system_pk' => $game_system_pk,
                ]);
            }

            if ($request->filled('game_tags')) {
                foreach ($request->get('game_tags') as $game_tag_pk) {
                    SessionTagsList::create([
                        'game_session_pk' => $gameSession->game_session_pk,
                        'game_style_tag_pk' => $game_tag_pk,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('find.group');
    }

}
