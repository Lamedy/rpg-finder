<?php

namespace App\Http\Controllers\Forms;

use App\Email\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAuthorization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Controller
{
    public function show(): View | RedirectResponse
    {
        if(Auth::check()){
            return redirect('/');
        }

        return view('Forms.ForgotPassword');
    }

    public function confirm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = UserAuthorization::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Такой email не зарегистрирован.'])->withInput();
        }

        $token = Password::createToken($user);

        $url = route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]);

        Mail::to($user->email)->send(new ResetPassword($url));

        return back()->with('status', 'Ссылка на сброс пароля отправлена!');
    }

    public function showResetForm(Password $token): View | RedirectResponse
    {
        if(Auth::check()){
            return redirect('/');
        }

        return view('Forms.ResetPassword');
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:user_authorization,email',
            'password' => 'required|string|confirmed|min:6',
            'token' => 'required',
        ]);

        $status = Password::broker('user_auths')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();

                Auth::login(User::where('user_pk', $user->user_pk)->first());
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', 'Пароль успешно изменён');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
