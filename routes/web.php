<?php

use App\Livewire\User\UserCreate;
use App\Livewire\User\UserEdit;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/user', UserIndex::class)->name('user.index');
    Route::get('/user/create', UserCreate::class)->name('user.create');
    Route::get('/user/{user}/edit', UserEdit::class)->name('user.edit');
});

require __DIR__ . '/settings.php';
