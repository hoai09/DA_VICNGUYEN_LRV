<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CompanyInfoController as AdminCompanyInfoController;
use App\Http\Controllers\Admin\ContactAdviceController as AdminContactAdviceController;
use App\Http\Controllers\Admin\ProjectImageController as AdminProjectImageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UploadController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ContactAdviceController;
use App\Http\Controllers\CompanyInfoController;




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
        Route::resource('categories_project',AdminProjectController::class);
        Route::resource('form',AdminContactAdviceController::class)->only(['index','show','destroy']);


        Route::get('/contact', [AdminCompanyInfoController::class, 'editContact'])->name('company_info.contact');
        Route::put('/contact', [AdminCompanyInfoController::class, 'updateContact']);

        Route::get('/social', [AdminCompanyInfoController::class, 'editSocial'])->name('company_info.social');
        Route::put('/social', [AdminCompanyInfoController::class, 'updateSocial']);

        Route::get('/studio', [AdminCompanyInfoController::class, 'editStudio'])->name('company_info.studio');
        Route::put('/studio', [AdminCompanyInfoController::class, 'updateStudio']);


        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        
        Route::post('categories_project/store-ajax', [AdminProjectController::class, 'storeAjax'])
        ->name('categories_project.store.ajax');
        Route::delete('categories_project/delete/{id}',[AdminProjectController::class,'deleteAjax'])
        ->name('categories_project.delete.ajax');


        Route::post('categories_news/store-ajax', [AdminNewsController::class, 'storeAjax'])
        ->name('categories_news.store.ajax');
        Route::delete('categories_news/delete/{id}', [AdminNewsController::class, 'deleteAjax'])
        ->name('categories_news.delete.ajax');

        Route::post('/ckeditor/upload', [UploadController::class, 'ckeditorUpload'])->name('ckeditor.upload');

    });


Route::prefix('/')->name('vicnguyen.')->group(function () {
    Route::get('/', fn() => view('sitevicnguyen.index'))->name('home');
    Route::view('/trangchu', 'sitevicnguyen.trangchu')->name('trangchu');
    
    Route::get('/footer',[CompanyInfoController::class,'indexsocials'])->name('socials.indexsocials');
    Route::get('/studio',[CompanyInfoController::class,'indexstudio'])->name('studio.indexstudio');
    Route::get('/address', [CompanyInfoController::class, 'index'])->name('address.index');
    
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/detail/{slug}', [NewsController::class, 'detail'])->name('news.detail');
    Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');


    Route::get('/infomation', [ContactAdviceController::class, 'create'])->name('infomation');
    Route::post('/infomation', [ContactAdviceController::class, 'store'])->name('infomation.store');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

});


Route::prefix('/about')->name('vicdesign.')->group(function () {
    Route::view('/about', 'sitevicnguyendesign.about')->name('about');
    Route::view('/indexdgn', 'sitevicnguyendesign.indexdgn')->name('indexdgn');
    Route::view('/model', 'sitevicnguyendesign.model')->name('model');
    Route::view('/portfolio', 'sitevicnguyendesign.portfolio')->name('portfolio');
    Route::view('/team', 'sitevicnguyendesign.team')->name('team');

    Route::get('/contact', [PortfolioContactController::class, 'create'])->name('contact');
    Route::post('/contact', [PortfolioContactController::class, 'store'])->name('contact.store');
});

require __DIR__.'/auth.php';
