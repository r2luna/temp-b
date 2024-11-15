<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\EmailListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TrackingController;
use App\Http\Middleware\CampaignCreateSessionControl;
use Illuminate\Support\Facades\Route;

Route::get('/t/{mail}/o', [TrackingController::class, 'openings'])->name('tracking.openings');
Route::get('/t/{mail}/c', [TrackingController::class, 'clicks'])->name('tracking.clicks');

Route::middleware(['auth', 'verified'])->group(function () {
    //region Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //endregion

    //region Email List
    Route::get('/email-list', [EmailListController::class, 'index'])->name('email-list.index');
    Route::get('/email-list/create', [EmailListController::class, 'create'])->name('email-list.create');
    Route::post('/email-list/create', [EmailListController::class, 'store']);
    Route::get('/email-list/{emailList}/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::get('/email-list/{emailList}/subscribers/create', [SubscriberController::class, 'create'])->name('subscribers.create');
    Route::post('/email-list/{emailList}/subscribers/create', [SubscriberController::class, 'store']);
    Route::delete('/email-list/{emailList}/subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
    Route::delete('/email-list/{emailList}', [EmailListController::class, 'destroy'])->name('email-list.delete');
    //endregion

    Route::resource('templates', TemplateController::class);

    //region Campaigns
    Route::get('/', [CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/create/{tab?}', [CampaignController::class, 'create'])->middleware(CampaignCreateSessionControl::class)->name('campaigns.create');
    Route::post('/campaigns/create/{tab?}', [CampaignController::class, 'store']);
    Route::get('/campaigns/{campaign}/{what?}', [CampaignController::class, 'show'])->name('campaigns.show')->withTrashed();

    Route::patch('/campaigns/{campaign}/restore', [CampaignController::class, 'restore'])->withTrashed()->name('campaigns.restore');
    Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
    //endregion
});

require __DIR__.'/auth.php';
