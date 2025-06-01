<?php

use App\Http\Controllers\FindGroup;
use App\Http\Controllers\Forms\Authorization;
use App\Http\Controllers\Forms\CreateCard;
use App\Http\Controllers\Forms\Registration;
use App\Http\Controllers\Main;
use App\Http\Controllers\User\Forms\ChangePassword;
use App\Http\Controllers\User\Forms\Settings;
use App\Http\Controllers\User\Profile;
use App\Http\Controllers\User\UserAdvertisements;
use Illuminate\Support\Facades\Route;

// Pages
Route::get('/', [Main::class, 'show'])->name('main');
Route::get('/findGroup', [FindGroup::class, 'show'])->name('find.group');

// Registration forms
Route::get('/registration', [Registration::class, 'show'])->name('registration');
Route::post('/registration', [Registration::class, 'submit'])->name('registration.submit');
Route::get('/registration/confirm', [Registration::class, 'showConfirmForm'])->name('registration.confirm');
Route::post('/registration/confirm', [Registration::class, 'confirmCode'])->name('registration.confirm.submit');

// Authorization forms
Route::get('/login', [Authorization::class, 'show'])->name('login');
Route::post('/login', [Authorization::class, 'submit'])->name('login.submit');

Route::get('/profile/{user}', [Profile::class, 'show'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/account/settings', [Settings::class, 'show'])->name('account.settings');
    Route::post('/account/settings', [Settings::class, 'submit'])->name('account.settings.update');
    Route::get('/account/settings/change_password', [ChangePassword::class, 'show'])->name('account.settings.change_password');
    Route::post('/account/settings/change_password', [ChangePassword::class, 'submit'])->name('account.settings.change_password.update');
    Route::get('/findGroup/MyAdvertisements', [UserAdvertisements::class, 'show'])->name('account.my_advertisements');

    Route::post('/logout', [Authorization::class, 'logout'])->name('logout');

    Route::get('/findGroup/createCard', [CreateCard::class, 'show'])->name('create.card');
    Route::post('/findGroup/createCard', [CreateCard::class, 'submit'])->name('create.card.update');
    Route::get('/findGroup/editCard/{card}', [CreateCard::class, 'edit'])->name('card.edit');
    Route::put('/findGroup/editCard/{card}', [CreateCard::class, 'acceptEdit'])->name('card.edit.accept');
    Route::delete('/findGroup/deleteCard/{card}', [CreateCard::class, 'delete'])->name('card.delete');

    Route::get('/profile/{user}/Edit', [Profile::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}/Edit', [Profile::class, 'submit'])->name('profile.edit.submit');
});
