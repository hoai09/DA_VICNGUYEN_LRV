<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;
use App\Http\Controllers\Admin\ContactInfoController as AdminContactInfoController;
use App\Http\Controllers\Admin\ProjectInformationController as AdminProjectInformationController;
use App\Http\Controllers\Admin\ProjectImageController as AdminProjectImageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UploadController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectInformationController;
use App\Http\Controllers\ContactInfoController;




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('news', AdminNewsController::class);
        Route::resource('projects', AdminProjectController::class);
        Route::resource('project_images', AdminProjectImageController::class);
        Route::resource('members', AdminMemberController::class);
        Route::resource('news_categories', AdminNewsCategoryController::class);
        Route::resource('contact_info', AdminContactInfoController::class);
        Route::resource('form',AdminProjectInformationController::class)->only(['index','show','destroy']);
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('/admin/ckeditor/upload', [UploadController::class, 'ckeditorUpload'])->name('ckeditor.upload');

        
    
        
    });


Route::prefix('/')->name('vicnguyen.')->group(function () {
    Route::get('/', fn() => view('sitevicnguyen.index'))->name('home');
    Route::view('/trangchu', 'sitevicnguyen.trangchu')->name('trangchu');
    Route::view('/studio', 'sitevicnguyen.studio')->name('studio');
    
    Route::get('/address', [ContactInfoController::class, 'index'])->name('address.index');
    
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/detail/{slug}', [NewsController::class, 'detail'])->name('news.detail');
    Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');


    Route::get('/infomation', [ProjectInformationController::class, 'create'])->name('infomation');
    Route::post('/infomation', [ProjectInformationController::class, 'store'])->name('infomation.store');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

});


Route::prefix('/about')->name('vicdesign.')->group(function () {
    Route::view('/about', 'sitevicnguyendesign.about')->name('about');
    Route::view('/indexdgn', 'sitevicnguyendesign.indexdgn')->name('indexdgn');
    Route::view('/model', 'sitevicnguyendesign.model')->name('model');
    Route::view('/portfolio', 'sitevicnguyendesign.portfolio')->name('portfolio');
    Route::view('/team', 'sitevicnguyendesign.team')->name('team');

    Route::get('/contact', [ProjectContactController::class, 'create'])->name('contact');
    Route::post('/contact', [ProjectContactController::class, 'store'])->name('contact.store');
});

require __DIR__.'/auth.php';
