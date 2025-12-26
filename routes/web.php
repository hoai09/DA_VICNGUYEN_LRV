<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ContactAdviceController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\PortfolioContactController;
use App\Http\Controllers\PortfolioMemberController;

Route::prefix('/')->name('vicnguyen.')->group(function () {
    Route::get('/', fn() => view('sitevicnguyen.index'))->name('home');
    Route::view('/trangchu', 'sitevicnguyen.trangchu')->name('trangchu');
    
    Route::get('/footer',[CompanyInfoController::class,'indexsocials'])->name('socials.indexsocials');
    Route::get('/studio',[CompanyInfoController::class,'indexstudio'])->name('studio.indexstudio');
    Route::get('/address', [CompanyInfoController::class, 'index'])->name('address.index');
    
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{slug}', [NewsController::class, 'detail'])->name('news.detail');

    Route::get('/infomation', [ContactAdviceController::class, 'create'])->name('infomation');
    Route::post('/infomation', [ContactAdviceController::class, 'store'])->name('infomation.store');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');

    Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

});

Route::prefix('/')->name('vicdesign.')->group(function () {
    Route::view('/about', 'sitevicnguyendesign.about')->name('about');
    Route::view('/indexdgn', 'sitevicnguyendesign.indexdgn')->name('indexdgn');
    Route::view('/model', 'sitevicnguyendesign.model')->name('model');
    Route::view('/portfolio', 'sitevicnguyendesign.portfolio')->name('portfolio');

    Route::get('/team', [PortfolioMemberController::class, 'index'])->name('team.index');

    Route::get('/contact', [PortfolioContactController::class, 'create'])->name('contact');
    Route::post('/contact', [PortfolioContactController::class, 'store'])->name('contact.store');
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';