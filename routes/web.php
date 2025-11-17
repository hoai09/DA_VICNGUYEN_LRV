<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;  
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;
use App\Http\Controllers\Admin\ContactInfoController as AdminContactInfoController;

use App\Http\Controllers\Admin\ProjectImageController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ProjectContactController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectInformationController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\Admin\UploadController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('projects', AdminProjectController::class);
        Route::resource('project_images', ProjectImageController::class);
        Route::resource('members', AdminMemberController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('news_categories', AdminNewsCategoryController::class);
        Route::resource('contact_info', AdminContactInfoController::class);
        

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/project-images', [ProjectImageController::class, 'index'])->name('project-images.index');
        Route::get('/project-images/create', [ProjectImageController::class, 'create'])->name('project-images.create');
        Route::post('/project-images/store', [ProjectImageController::class, 'store'])->name('project-images.store');
        Route::delete('/project-images/{projectImage}', [ProjectImageController::class, 'destroy'])->name('project-images.destroy');

        Route::get('/admin/members',[AdminMemberController::class,'index'])->name('members.index');
        Route::get('/admin/members/create',[AdminMemberController::class,'create'])->name('members.create');
        Route::post('/admin/members',[AdminMemberController::class,'store'])->name('members.store');
        Route::post('/admin/members/{member}',[AdminMemberController::class,'show'])->name('members.show');
        Route::post('/admin/members/{member}/edit',[AdminMemberController::class,'edit'])->name('members.edit');
        Route::put('/admin/members/{member}',[AdminMemberController::class,'update'])->name('members.update');
        Route::put('/admin/members/{member}',[AdminMemberController::class,'destroy'])->name('members.destroy');

        Route::get('/admin/contact_info',[AdminContactInfoController::class,'index'])->name('contact_info.index');
        Route::get('/admin/contact_info/create',[AdminContactInfoController::class,'create'])->name('contact_info.create');
        Route::post('/admin/contact_info',[AdminContactInfoController::class,'store'])->name('contact_info.store');
        Route::post('/admin/contact_info/{contactInfos}',[AdminContactInfoController::class,'show'])->name('contact_info.show');
        Route::post('/admin/contact_info/{contactInfos}/edit',[AdminContactInfoController::class,'edit'])->name('contact_info.edit');
        Route::put('/admin/contact_info/{contactInfos}',[AdminContactInfoController::class,'update'])->name('contact_info.update');
        Route::delete('/admin/contact_info/{contactInfos}',[AdminContactInfoController::class,'destroy'])->name('contact_info.destroy');

        Route::get('/admin/news',[AdminNewsController::class,'index'])->name('news.index');
        Route::get('/admin/news/create',[AdminNewsController::class,'create'])->name('news.create');
        Route::post('/admin/news',[AdminNewsController::class,'store'])->name('news.store');
        Route::post('/admin/news/{news}',[AdminNewsController::class,'show'])->name('news.show');
        Route::post('/admin/news/{news}/edit',[AdminNewsController::class,'edit'])->name('news.edit');
        Route::put('/admin/news/{news}',[AdminNewsController::class,'update'])->name('news.update');
        Route::put('/admin/news/{news}',[AdminNewsController::class,'destroy'])->name('news.destroy');

        Route::post('/admin/ckeditor/upload', [UploadController::class, 'ckeditorUpload'])->name('ckeditor.upload');

        Route::get('/admin/news_categories',[AdminNewsCategoryController::class,'index'])->name('news_categories.index');
        Route::get('/admin/news_categories/create',[AdminNewsCategoryController::class,'create'])->name('news_categories.create');
        Route::post('/admin/news_categories',[AdminNewsCategoryController::class,'store'])->name('news_categories.store');
        Route::post('/admin/news_categories/{news_categories}',[AdminNewsCategoryController::class,'show'])->name('news_categories.show');
        Route::post('/admin/news_categories/{news_categories}/edit',[AdminNewsCategoryController::class,'edit'])->name('news_categories.edit');
        Route::put('/admin/news_categories/{news_categories}',[AdminNewsCategoryController::class,'update'])->name('news_categories.update');
        Route::put('/admin/news_categories/{news_categories}',[AdminNewsCategoryController::class,'destroy'])->name('news_categories.destroy');

        
    });


Route::prefix('/')->name('vicnguyen.')->group(function () {
    Route::get('/', fn() => view('sitevicnguyen.index'))->name('home');
    Route::view('/trangchu', 'sitevicnguyen.trangchu')->name('trangchu');
    Route::view('/studio', 'sitevicnguyen.studio')->name('studio');
    
    Route::get('/address', [ContactInfoController::class, 'index'])->name('address.index');
    
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{id}', [NewsController::class, 'detail'])->name('news.detail');

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
