<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ContactMethods;
use App\Models\GameExperience;
use App\Models\GameStyleTag;
use App\Models\GameSystemList;
use App\Models\GameSystems;
use App\Models\User;
use App\Models\UserContactsList;
use App\Models\UserTagList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class Profile extends Controller
{
    public function show(User $user): View
    {
        $role = '';
        switch ($user->game_role) {
            case 0:
                $role = 'Игрока';
                break;
            case 1:
                $role = 'Мастера';
                break;
            case 2:
                $role = 'Любую';
                break;
        }

        $gender = match ((int) $user->user_gender) {
            0 => 'Женский',
            1 => 'Мужской',
            default => 'Не указан',
        };

        $user->load(['gameSystemsList.system', 'gameSystemsList.experience', 'userTagsList.tags', 'userContactsList.contacts']);

        return view('UserPages.Profile')->with([
            'user' => $user,
            'city' => City::where('city_pk', $user->city_pk)->value('city'),
            'gender' => $gender,
            'role' => $role,
        ]);
    }

    public function edit(User $user): View | RedirectResponse
    {
        if ($user->user_pk !== Auth::user()->user_pk) {
            return redirect()->back();
        }


        $role = '';
        switch ($user->game_role) {
            case 0:
                $role = 'Игрока';
                break;
            case 1:
                $role = 'Мастера';
                break;
            case 2:
                $role = 'Любую';
                break;
        }

        $gender = match ((int) $user->user_gender) {
            0 => 'Женский',
            1 => 'Мужской',
            default => 'Не указан',
        };

        $user->load(['gameSystemsList.system', 'gameSystemsList.experience', 'userTagsList.tags', 'userContactsList.contacts']);

        $tags = $user->userTagsList->pluck('user_game_style_tag_pk')->all();
        return view('UserPages.Forms.ProfileEdit')->with([
            'user' => $user,
            'city' => City::where('city_pk', $user->city_pk)->value('city'),
            'gender' => $gender,
            'role' => $role,
            'tags' => $tags,
            'gameTags' => GameStyleTag::select('game_style_tag_pk', 'game_style_tag')->get(),
            'cityList' => City::all(),
            'systems' => GameSystems::all(),
            'experiences' => GameExperience::all(),
            'contactTypes' => ContactMethods::all(),
        ]);
    }

    public function submit(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'user_name'         => 'nullable|string|max:50',
            'avatar'            => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'birthdate'         => 'nullable|date|before_or_equal:today|after:1900-01-01',
            'city_id'           => 'nullable|exists:city,city_pk',
            'gender'            => 'nullable|in:0,1',
            'role'              => 'nullable|in:0,1,2',
            'systems'           => 'nullable|array',
            'systems.*'         => 'nullable|exists:game_system,game_system_pk',
            'experience'        => 'nullable|array',
            'experience.*'      => 'nullable|exists:game_experience,game_experience_pk',
            'game_tags'         => 'nullable|array',
            'game_tags.*'       => 'integer|exists:game_style_tag,game_style_tag_pk',
            'contacts'          => 'nullable|array',
            'contacts.*'        => 'nullable|exists:contact_methods,contact_methods_pk',
            'contact_values'    => 'nullable|array',
            'contact_values.*'  => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            if (!empty($validated['avatar'])) {
                if ($user->avatar && $user->avatar != 'avatars/default_avatar.png' && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $avatarPath = $validated['avatar']->store('avatars', 'public');
                $user->avatar = $avatarPath;
            }

            $user->user_name    = $validated['user_name'] ?? $user->user_name;
            $user->birthdate    = $validated['birthdate'];
            $user->user_gender  = $validated['gender'];
            $user->city_pk      = $validated['city_id'];
            $user->game_role    = $validated['role'];
            $user->save();

            GameSystemList::where('user_pk', $user->user_pk)->delete();

            foreach ($validated['systems'] as $index => $systemId) {
                $experienceId = $validated['experience'][$index] ?? null;

                if ($systemId && $experienceId) {
                    GameSystemList::create([
                        'user_pk'            => $user->user_pk,
                        'game_system_pk'     => $systemId,
                        'game_experience_pk' => $experienceId,
                    ]);
                }
            }

            UserTagList::where('user_pk', $user->user_pk)->delete();

            if (!empty($validated['game_tags'])) {
                foreach ($validated['game_tags'] as $game_tag_pk) {
                    UserTagList::create([
                        'user_pk' => $user->user_pk,
                        'user_game_style_tag_pk' => $game_tag_pk,
                    ]);
                }
            }

            UserContactsList::where('user_pk', $user->user_pk)->delete();

            if (!empty($validated['contacts'])) {
                foreach ($validated['contacts'] as $index => $contact_method ) {
                    if ($contact_method && $validated['contact_values'][$index]) {
                        UserContactsList::create([
                            'user_pk' => $user->user_pk,
                            'contact_methods_pk' => $contact_method,
                            'contact_value' => $validated['contact_values'][$index],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('profile', $user)->with('success', 'Профиль обновлён.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Ошибка при обновлении профиля: ' . $e->getMessage()]);
        }
    }
}
