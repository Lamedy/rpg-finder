<?php

use App\Http\Controllers\Main;
use App\Http\Controllers\FindGroup;

use App\Http\Controllers\Forms\Authorization;
use App\Http\Controllers\Forms\Registration;
use App\Http\Controllers\Forms\CreateCard;

use Illuminate\Support\Facades\Route;

// Pages
Route::get('/', [Main::class, 'show'])->name('main');
Route::get('/findGroup', [FindGroup::class, 'show'])->name('find.group');

// Forms
Route::get('/findGroup/createCard', [CreateCard::class, 'show'])->name('create.card');

// Registration forms
Route::get('/registration', [Registration::class, 'show'])->name('registration');
Route::post('/registration', [Registration::class, 'submit'])->name('registration.submit');
Route::get('/registration/confirm', [Registration::class, 'showConfirmForm'])->name('registration.confirm');
Route::post('/registration/confirm', [Registration::class, 'confirmCode'])->name('registration.confirm.submit');

// Authorization forms
Route::get('/authorization', [Authorization::class, 'show'])->name('authorization');
Route::post('/authorization', [Authorization::class, 'submit'])->name('authorization.submit');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [Authorization::class, 'logout'])->name('logout');
});
