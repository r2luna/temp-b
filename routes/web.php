<?php

use App\Http\Controllers\EmailListController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Auth::loginUsingId(1);

    return to_route('dashboard');
});

Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/email-list', [EmailListController::class, 'index'])->name('email-list.index');
    Route::get('/email-list/create', [EmailListController::class, 'create'])->name('email-list.create');
    Route::post('/email-list/store', [EmailListController::class, 'store'])->name('email-list.store');
});

require __DIR__.'/auth.php';
