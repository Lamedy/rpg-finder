<?php

namespace App\Http\Controllers\User\Forms;

use App\Http\Controllers\Controller;
use App\Models\UserAuthorization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ChangePassword extends Controller
{
    public function show(): View
    {
        return view('UserPages.Forms.ChangePassword');
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|confirmed|min:6',
        ]);

        $user = UserAuthorization::where('user_pk', Auth::id())->first();

        // Проверка текущего пароля
        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Неверный пароль'])->withInput();
        }

        // Обновление пароля
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return redirect()->back()->with('status', 'Пароль успешно обновлён.');
    }

}
