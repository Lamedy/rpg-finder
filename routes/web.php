<?php

use App\Http\Controllers\FindGroup;
use App\Http\Controllers\Forms\Authorization;
use App\Http\Controllers\Forms\CreateCard;
use App\Http\Controllers\Forms\ForgotPassword;
use App\Http\Controllers\Forms\Registration;
use App\Http\Controllers\Main;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\User\Forms\ChangePassword;
use App\Http\Controllers\User\Forms\Settings;
use App\Http\Controllers\User\Notifications;
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
Route::get('/forgotPassword', [ForgotPassword::class, 'show'])->name('forgot_password');
Route::post('/forgotPassword', [ForgotPassword::class, 'confirm'])->name('forgot_password.confirm');
Route::get('/reset-password/{token}', [ForgotPassword::class, 'showResetForm'])->name('password.reset');
Route::put('/reset-password', [ForgotPassword::class, 'reset'])->name('password.reset.update');

// Authorization forms
Route::get('/login', [Authorization::class, 'show'])->name('login');
Route::post('/login', [Authorization::class, 'submit'])->name('login.submit');

Route::get('/profile/{user}', [Profile::class, 'show'])->name('profile');

Route::get('/room/{room}', [RoomController::class, 'show'])->name('room');

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

    Route::get('/account/notifications', [Notifications::class, 'show'])->name('account.notifications');

    Route::put('/room/{room}/{notice}/accept', [RoomController::class, 'acceptInvite'])->name('accept_invite');
    Route::put('/room/{room}/{notice}/decline', [RoomController::class, 'notAcceptInvite'])->name('not_accept_invite');
    Route::post('/room/{room}', [RoomController::class, 'join'])->name('room.join');
});

// test ci/cd part 3
