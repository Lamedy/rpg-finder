<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAuthorization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class Authorization extends Controller
{
    public function show(): View | RedirectResponse
    {
        if(Auth::check()){
            return redirect('/');
        }

        return view('Forms.Authorization');
    }

    public function submit(Request $request): RedirectResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'login' => 'required_without:email|string|max:50',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $login = $request->input('login');
        $password = $request->input('password');

        $user = UserAuthorization::where('login', $login)->first();

        if (!$user) {
            return redirect()->back()->withErrors([
                'login' => 'Пользователь с таким логином не найден'
            ])->withInput();
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Неверный пароль'])->withInput();
        }

        $user = User::find($user->user_pk);

        Auth::login($user);

        return redirect()->route('main');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('main');
    }
}
