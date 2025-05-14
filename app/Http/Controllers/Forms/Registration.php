<?php

namespace App\Http\Controllers\Forms;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAuthorization;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Registration extends Controller
{
    public function show(): View
    {
        return view('Forms.registration');
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|email|unique:user_authorization,email',
            'gender' => 'nullable|in:0,1',
            'birthdate' => 'nullable|date',
        ]);

        $code = 123456;
        //$code = rand(100000, 999999);       // todo отправлять код на почту

        // Сохраняем данные и код во временную сессию
        Session::put('pending_registration', $validated);
        Session::put('confirmation_code', $code);

        return redirect()->route('registration.confirm');
    }

    public function showConfirmForm(): View | RedirectResponse
    {
        // Показываем форму только если есть данные
        if (!Session::has('pending_registration')) {
            return redirect()->route('registration');
        }

        return view('Forms.registrationConfirm');
    }

    public function confirmCode(Request $request): RedirectResponse
    {
        $request->validate(['code' => 'required|numeric']);

        if ($request->input('code') == Session::get('confirmation_code')) {
            $data = Session::get('pending_registration');

            DB::beginTransaction();

            try {

                $user = User::create([
                    'user_name' => $data['name'],
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
                return redirect()->route('main')->with('success', 'Регистрация завершена!');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        return back()->withErrors(['code' => 'Неверный код подтверждения.']);
    }
}
