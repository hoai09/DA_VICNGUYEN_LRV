<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CompanyInfoController as AdminCompanyInfoController;
use App\Http\Controllers\Admin\ContactAdviceController as AdminContactAdviceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectImageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\ProfileController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('news', AdminNewsController::class);
        Route::post('categories_news/store-ajax', [AdminNewsController::class, 'storeAjax'])
        ->name('categories_news.store.ajax');
        Route::delete('categories_news/delete/{id}', [AdminNewsController::class, 'deleteAjax'])
        ->name('categories_news.delete.ajax');

        Route::resource('projects', AdminProjectController::class);
        Route::post('categories_project/store-ajax', [AdminProjectController::class, 'storeAjax'])
        ->name('categories_project.store.ajax');
        Route::delete('categories_project/delete/{id}',[AdminProjectController::class,'deleteAjax'])
        ->name('categories_project.delete.ajax');

        Route::resource('project_images', ProjectImageController::class);

        Route::resource('members', AdminMemberController::class);

        // Route::resource('categories_project',AdminProjectController::class);

        Route::resource('form',AdminContactAdviceController::class)->only(['index','show','destroy']);


        Route::get('/contact', [AdminCompanyInfoController::class, 'editContact'])->name('company_info.contact');
        Route::put('/contact', [AdminCompanyInfoController::class, 'updateContact']);

        Route::get('/social', [AdminCompanyInfoController::class, 'editSocial'])->name('company_info.social');
        Route::put('/social', [AdminCompanyInfoController::class, 'updateSocial']);

        Route::get('/studio', [AdminCompanyInfoController::class, 'editStudio'])->name('company_info.studio');
        Route::put('/studio', [AdminCompanyInfoController::class, 'updateStudio']);

        Route::patch('/form/{form}/status', [AdminContactAdviceController::class, 'updateStatus'])
        ->name('form.status');

        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/user/index',[UserController::class,'index'])->name('user.index');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('/ckeditor/upload', [UploadController::class, 'ckeditorUpload'])->name('ckeditor.upload');

    });