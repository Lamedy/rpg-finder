<?php

namespace App\Http\Controllers\Forms;

use App\Email\CodeConfirm;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAuthorization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class Registration extends Controller
{
    public function show(): View
    {
        return view('Forms.Registration');
    }

    public function submit(Request $request): RedirectResponse
    {
        $validator = $request->validate([
            'login' => 'required|string|max:50|unique:user_authorization,login',
            'name' => 'nullable|string|max:50',
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|email|max:255|unique:user_authorization,email',
            'gender' => 'nullable|in:0,1',
            'birthdate' => 'nullable|date|before_or_equal:today|after:1900-01-01',
        ]);

        $code = rand(100000, 999999);

        Mail::to($validator['email'])->send(new CodeConfirm($code));

        // Сохраняем данные и код во временную сессию
        Session::put('pending_registration', $validator);
        Session::put('confirmation_code', $code);

        return redirect()->route('registration.confirm');
    }

    public function showConfirmForm(): View | RedirectResponse
    {
        if (!Session::has('pending_registration')) {
            return redirect()->route('registration');
        }

        return view('Forms.RegistrationConfirm');
    }

    public function confirmCode(Request $request): RedirectResponse
    {
        $request->validate(['code' => 'required|numeric|min:100000|max:999999']);

        if ($request->input('code') == Session::get('confirmation_code')) {
            $data = Session::get('pending_registration');

            DB::beginTransaction();

            try {
                $user = User::create([
                    'user_name' => $data['name'] ?? $data['login'],
                    'user_gender' => $data['gender'],
                    'birthdate' => $data['birthdate'],
                ]);

                UserAuthorization::create([
                    'user_pk' => $user->user_pk,
                    'login' => $data['login'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),    // todo изучить подробнее методы хеширования паролей для лучшей безопасности
                ]);

                DB::commit();

                Session::forget(['pending_registration', 'confirmation_code']);

                Auth::login($user);

                return redirect()->route('main')->with('success', 'Регистрация завершена!');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        return back()->withErrors(['code' => 'Неверный код подтверждения.']);
    }
}
