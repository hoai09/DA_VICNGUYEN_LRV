<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioContactController;
use App\Http\Controllers\PortfolioMemberController;

Route::prefix('/')->name('vicdesign.')->group(function () {
    Route::view('/about', 'sitevicnguyendesign.about')->name('about');
    Route::view('/indexdgn', 'sitevicnguyendesign.indexdgn')->name('indexdgn');
    Route::view('/model', 'sitevicnguyendesign.model')->name('model');
    Route::view('/portfolio', 'sitevicnguyendesign.portfolio')->name('portfolio');

    Route::get('/team', [PortfolioMemberController::class, 'index'])->name('team.index');

    Route::get('/contact', [PortfolioContactController::class, 'create'])->name('contact');
    Route::post('/contact', [PortfolioContactController::class, 'store'])->name('contact.store');
});