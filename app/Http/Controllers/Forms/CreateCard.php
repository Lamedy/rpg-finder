<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ContactMethods;
use App\Models\GameSession;
use App\Models\GameSessionSystemList;
use App\Models\GameStyleTag;
use App\Models\GameSystems;
use App\Models\SessionContactsList;
use App\Models\SessionTagsList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CreateCard extends Controller
{
    public function show(): View
    {
        $user = Auth::user();
        $user->load(['gameSystemsList.system', 'userTagsList.tags', 'userContactsList.contacts']);

        $gameSystems = $user->gameSystemsList->pluck('game_system_pk')->all();
        $userTags = $user->userTagsList->pluck('user_game_style_tag_pk')->all();

        switch ($user->game_role){
            case 0:
                $find_role = 1;
                break;
            case 1:
                $find_role = 0;
                break;
            default:
                $find_role = null;
        }

        $session = new GameSession([
            'city_pk' => $user->city_pk,
            'player_type_needed' => $find_role ,
        ]);

        return view('Forms.CreateCard')
            ->with([
                'gameSystems' => GameSystems::select('game_system_pk', 'game_system_name')->get(),
                'gameTags' => GameStyleTag::select('game_style_tag_pk', 'game_style_tag')->get(),
                'cityList' => City::select('city_pk', 'city')->get(),
                'selectedGameSystems' => $gameSystems,
                'selectedGameTags' => $userTags,
                'cardInfo' => $session,
                'contactTypes' => ContactMethods::all(),
                'knownContacts' => $user->userContactsList,
            ]);
    }

    public function submit(Request $request): RedirectResponse
    {
        $request->replace($this->clearEmptyRows($request));

        $validated = $request->validate([
            'player_type'       => 'required|in:0,1',
            'player_count'      => 'required_if:player_type,0|nullable|integer|min:1|max:16',
            'game_format'       => 'required|in:0,1,2',
            'game_systems'      => 'required|array|min:1',
            'game_systems.*'    => 'integer|exists:game_system,game_system_pk',
            'game_duration'     => 'required|in:0,1,2',
            'game_tags'         => 'nullable|array',
            'game_tags.*'       => 'integer|exists:game_style_tag,game_style_tag_pk',
            'description'       => 'nullable|string|max:3000',
            'city_id'           => 'required_unless:game_format,1|nullable|integer|exists:city,city_pk',
            'game_place'        => 'nullable|string|max:512',
            'date'              => 'nullable|date|after_or_equal:today|required_with:time',
            'time'              => 'nullable|date_format:H:i',
            'price'             => 'nullable|numeric|min:0|max:100000',
            'contacts'          => 'required|nullable|array',
            'contacts.*'        => 'nullable|exists:contact_methods,contact_methods_pk',
            'contact_values'    => 'required|nullable|array',
            'contact_values.*'  => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $date = $validated['date'];
            $time = $validated['time'];
            $datetime = null;

            if ($date && $time) {
                $datetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "$date $time");
            } elseif ($date) {
                $datetime = $date;
            }

            $gameSession = GameSession::create([
                'player_type_needed' => $validated['player_type'],
                'player_count' => !$validated['player_type'] ? $validated['player_count'] : null,
                'game_format' => $validated['game_format'],
                'game_duration' => $validated['game_duration'],
                'game_description' => $validated['description'],
                'game_place' => (!$validated['player_type'] && (int)$validated['game_format'] !== 1) ? $validated['game_place'] : null,
                'game_date' => !$validated['player_type']  ? $datetime  : null,
                'author' => Auth::user()->user_pk,
                'city_pk' => (int)$validated['game_format'] !== 1 ? $validated['city_id'] : null,
                'price' =>  !$validated['player_type'] ? $validated['price'] : 0,
            ]);

            foreach ($validated['game_systems'] as $game_system => $game_system_pk) {
                GameSessionSystemList::create([
                    'game_session_pk' => $gameSession->game_session_pk,
                    'game_system_pk' => $game_system_pk,
                ]);
            }

            if (!empty($validated['game_tags'])) {
                foreach ($validated['game_tags'] as $game_tag_pk) {
                    SessionTagsList::create([
                        'game_session_pk' => $gameSession->game_session_pk,
                        'game_style_tag_pk' => $game_tag_pk,
                    ]);
                }
            }

            SessionContactsList::where('game_session_pk', $gameSession->game_session_pk)->delete();
            if (!empty($validated['contacts'])) {
                foreach ($validated['contacts'] as $index => $contact_method ) {
                    if ($contact_method && $validated['contact_values'][$index]) {
                        SessionContactsList::create([
                            'game_session_pk' => $gameSession->game_session_pk,
                            'contact_methods_pk' => $contact_method,
                            'contact_value' => $validated['contact_values'][$index],
                        ]);
                    }
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

    public function edit(GameSession $card): View
    {
        return view('Forms.CreateCard')->with([
            'cardInfo' => $card,
            'gameSystems' => GameSystems::select('game_system_pk', 'game_system_name')->get(),
            'gameTags' => GameStyleTag::select('game_style_tag_pk', 'game_style_tag')->get(),
            'cityList' => City::select('city_pk', 'city')->get(),
            'selectedGameSystems' => GameSessionSystemList::query()
                ->where('game_session_pk', $card->game_session_pk)
                ->pluck('game_system_pk'),
            'selectedGameTags' => SessionTagsList::query()
                ->where('game_session_pk', $card->game_session_pk)
                ->pluck('game_style_tag_pk'),
            'contactTypes' => ContactMethods::all(),
            'knownContacts' => SessionContactsList::where('game_session_pk', $card->game_session_pk)->get(),
        ]);
    }

    public function delete(GameSession $card): RedirectResponse
    {
        $card->delete();

        return redirect()->back();
    }

    public function acceptEdit(Request $request, GameSession $card): RedirectResponse
    {
        $request->replace($this->clearEmptyRows($request));

        $validated = $request->validate([
            'player_type'       => 'required|in:0,1',
            'player_count'      => 'required_if:player_type,0|nullable|integer|min:1|max:16',
            'game_format'       => 'required|in:0,1,2',
            'game_systems'      => 'required|array|min:1',
            'game_systems.*'    => 'integer|exists:game_system,game_system_pk',
            'game_duration'     => 'required|in:0,1,2',
            'game_tags'         => 'nullable|array',
            'game_tags.*'       => 'integer|exists:game_style_tag,game_style_tag_pk',
            'description'       => 'nullable|string|max:3000',
            'city_id'           => 'required_unless:game_format,1|nullable|integer|exists:city,city_pk',
            'game_place'        => 'nullable|string|max:512',
            'date'              => 'nullable|date|after_or_equal:today|required_with:time',
            'time'              => 'nullable|date_format:H:i',
            'price'             => 'nullable|numeric|min:0|max:100000',
            'contacts'          => 'required|nullable|array',
            'contacts.*'        => 'nullable|exists:contact_methods,contact_methods_pk',
            'contact_values'    => 'required|nullable|array',
            'contact_values.*'  => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $date = $validated['date'];
            $time = $validated['time'];
            $datetime = null;

            if ($date && $time) {
                $datetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "$date $time");
            } elseif ($date) {
                $datetime = $date;
            }

            $card->update([
                'player_type_needed' => $validated['player_type'],
                'player_count' => !$validated['player_type'] ? $validated['player_count'] : null,
                'game_format' => $validated['game_format'],
                'game_duration' => $validated['game_duration'],
                'game_description' => $validated['description'],
                'game_place' => (!$validated['player_type'] && (int)$validated['game_format'] !== 1) ? $validated['game_place'] : null,
                'game_date' => !$validated['player_type'] ? $datetime  : null,
                'author' => Auth::user()->user_pk,
                'city_pk' => (int)$validated['game_format'] !== 1 ? $validated['city_id'] : null,
                'price' =>  !$validated['player_type'] ? $validated['price'] : 0,
            ]);

            GameSessionSystemList::where('game_session_pk', $card->game_session_pk)->delete();
            SessionTagsList::where('game_session_pk', $card->game_session_pk)->delete();

            foreach ($validated['game_systems'] as $game_system_pk) {
                GameSessionSystemList::create([
                    'game_session_pk' => $card->game_session_pk,
                    'game_system_pk' => $game_system_pk,
                ]);
            }

            if (!empty($validated['game_tags'])) {
                foreach ($validated['game_tags'] as $game_tag_pk) {
                    SessionTagsList::create([
                        'game_session_pk' => $card->game_session_pk,
                        'game_style_tag_pk' => $game_tag_pk,
                    ]);
                }
            }

            SessionContactsList::where('game_session_pk', $card->game_session_pk)->delete();
            if (!empty($validated['contacts'])) {
                foreach ($validated['contacts'] as $index => $contact_method ) {
                    if ($contact_method && $validated['contact_values'][$index]) {
                        SessionContactsList::create([
                            'game_session_pk' => $card->game_session_pk,
                            'contact_methods_pk' => $contact_method,
                            'contact_value' => $validated['contact_values'][$index],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('find.group')->with('success', 'Карточка успешно обновлена.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function clearEmptyRows(Request $request): array
    {
        $input = $request->all();

        $contacts = collect($input['contacts'] ?? []);
        $values = collect($input['contact_values'] ?? []);

        // Очищаем пустые строки
        $filtered = $contacts->zip($values)->filter(function ($pair) {
            return trim($pair[0]) !== '' || trim($pair[1]) !== '';
        });

        $input['contacts'] = $filtered->pluck(0)->values()->all();
        $input['contact_values'] = $filtered->pluck(1)->values()->all();

        return $input;
    }
}
