<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GameSession;
use App\Models\GameStyleTag;
use App\Models\GameSystems;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Illuminate\Http\Request;

class FindGroup extends Controller
{
    public function show(Request $request): View | RedirectResponse
    {
        $countCardsOnOnePage = 5;

        $validated = $request->validate([
            'city_id' => 'nullable|integer|exists:city,city_pk',
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0',
            'game_format' => 'nullable|array',
            'game_format.*' => 'in:0,1',            // 0 - live, 1 - online
            'my_game_role' => 'nullable|array',
            'my_game_role.*' => 'in:0,1',           // 1 - player, 0 - master
            'game_duration' => 'nullable|array',
            'game_duration.*' => 'in:0,1',            // 0 - one game, 1 - campaign
            'game_systems' => 'nullable|array',
            'game_systems.*' => 'int',
            'game_tags' => 'nullable|array',
            'game_tags.*' => 'int',
        ]);

        $query = GameSession::with([
            'gameSystems.system',
            'city',
            'tags.tag',
            'user',
            'contacts'
        ]);

        if (!isset($request['load_city'])) {
            $request->merge(['load_city' => true]);
        }

        if (isset($validated['city_id']) && $validated['city_id'] !== '') {
            $cityId = $validated['city_id'];
        } elseif ($request['load_city'] && Auth::user() && Auth::user()->city_pk !== null) {
            $cityId = Auth::user()->city_pk;
        } else {
            $cityId = null;
        }

        if ($cityId !== null) {
            $query->where(function ($q) use ($cityId) {
                $q->where('city_pk', $cityId)
                    ->orWhereNull('city_pk');
            });
        }

        if (isset($validated['price_min']) && $validated['price_min'] !== '') {
            $query->where('price', '>=', $validated['price_min']);
        }

        if (isset($validated['price_max']) && $validated['price_max'] !== '') {
            $query->where('price', '<=', $validated['price_max']);
        }

        if (isset($validated['game_format']) && !empty($validated['game_format'])) {
            $query->where(function ($q) use ($validated) {
                $q->whereIn('game_format', $validated['game_format'])
                    ->orWhere('game_format', 2); // 2 — ANY
            });
        }

        if (isset($validated['my_game_role']) && !empty($validated['my_game_role'])) {
            $query->whereIn('player_type_needed', $validated['my_game_role']);
        }

        if (isset($validated['game_duration']) && !empty($validated['game_duration'])) {
            $query->where(function ($q) use ($validated) {
                $q->whereIn('game_duration', $validated['game_duration'])
                    ->orWhere('game_duration', 2); // 2 — ANY
            });
        }

        if (!empty($validated['game_systems'])) {
            $query->whereHas('gameSystems', function ($q) use ($validated) {
                $q->whereIn('game_system_pk', $validated['game_systems']);
            });
        }

        if (!empty($validated['game_tags'])) {
            $query->whereHas('tags', function ($q) use ($validated) {
                $q->whereIn('game_style_tag_pk', $validated['game_tags']);
            });
        }

        $games = $query->paginate($countCardsOnOnePage)->appends(request()->except('page'));

        if (Auth::check()) {
            $userId = Auth::user()->user_pk;
            foreach ($games as $game) {
                $game->playerInviteForCurrentUser = $game->playerInviteForUser($userId)->first();
            }
        }

        $cityList = City::select('city_pk', 'city')->get();
        $gameSystems = GameSystems::select('game_system_pk', 'game_system_name')->get();
        $gameTags = GameStyleTag::select('game_style_tag_pk', 'game_style_tag')->get();
        $city_id = $validated['city_id'] ?? null;
        if ($request['load_city']) {
            $city_id = Auth::user()->city_pk ?? null;
        }

        return view('FindGroup', compact('games', 'cityList', 'gameSystems', 'gameTags', 'city_id'));
    }
}
