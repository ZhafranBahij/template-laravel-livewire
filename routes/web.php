<?php

use App\Livewire\Role\RoleCreate;
use App\Livewire\Role\RoleEdit;
use App\Livewire\Role\RoleIndex;
use App\Livewire\User\UserCreate;
use App\Livewire\User\UserEdit;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::group(['middleware' => ['can:user.*']], function () {
        Route::get('/user', UserIndex::class)->name('user.index');
        Route::get('/user/create', UserCreate::class)->name('user.create');
        Route::get('/user/{user}/edit', UserEdit::class)->name('user.edit');
    });

    Route::group(['middleware' => ['can:role.*']], function () {
        Route::get('/role', RoleIndex::class)->name('role.index');
        Route::get('/role/create', RoleCreate::class)->name('role.create');
        Route::get('/role/{role}/edit', RoleEdit::class)->name('role.edit');
    });
});

require __DIR__ . '/settings.php';
