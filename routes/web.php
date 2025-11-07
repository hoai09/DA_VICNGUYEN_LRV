<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectContactController;
use App\Http\Controllers\ProjectInformationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->name('vicnguyen.')->group(function () {
    Route::get('/', function () {
        return view('sitevicnguyen.index');
    })->name('home');

    Route::get('/trangchu', function () {
        return view('sitevicnguyen.trangchu');
    })->name('trangchu');
    Route::get('/project',function(){
        return view('sitevicnguyen.project');
    })->name('project');
    Route::get('/studio',function(){
        return view('sitevicnguyen.studio');
    })->name('studio');
    Route::get('/news',function(){
        return view('sitevicnguyen.news');
    })->name('news');
    Route::get('/chitiettintuc',function(){
        return view('sitevicnguyen.chitiettintuc');
    })->name('chitiettintuc');
    Route::get('/address',function(){
        return view('sitevicnguyen.address');
    })->name('address');
    Route::get('/infomation', [ProjectInformationController::class, 'create'])->name('infomation');
    Route::post('/infomation', [ProjectInformationController::class, 'store'])->name('infomation.store');
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
});


Route::prefix('/')->name('vicdesign.')->group(function () {
    Route::get('/about',function(){
        return view('sitevicnguyendesign.about');
    })->name('about');
    Route::get('/contact',[ProjectContactController::class,'create'])->name('contact');
    Route::post('/contact',[ProjectContactController::class,'store'])->name('contact.store');
    Route::get('/indexdgn',function(){
        return view('sitevicnguyendesign.indexdgn');
    })->name('indexdgn');

    Route::get('/model',function(){
        return view('sitevicnguyendesign.model');
    })->name('model');

    Route::get('/portfolio',function(){
        return view('sitevicnguyendesign.portfolio');
    })->name('portfolio');

    Route::get('/team',function(){
        return view('sitevicnguyendesign.team');
    })->name('team');
});
