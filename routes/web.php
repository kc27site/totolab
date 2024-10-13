<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\PredictionController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\RedirectIfNotAdmin;

Route::get('/', [HomeController::class, 'index'])->name('top');
Route::get('/article/{no}', [HomeController::class, 'article'])->name('article');


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [TeamController::class, 'top'])->name('top');
        Route::get('/setting', [AdminController::class, 'edit'])->name('setting');
        Route::post('/setting', [AdminController::class, 'update'])->name('setting.update');
        Route::prefix('teams')->name('teams.')->group(function () {
            Route::get('/', [TeamController::class, 'index'])->name('index');
            Route::get('/create', [TeamController::class, 'create'])->name('create');
            Route::post('/', [TeamController::class, 'store'])->name('store');
            Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('edit');
            Route::put('/{team}', [TeamController::class, 'update'])->name('update');
            Route::delete('/{team}', [TeamController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('schedules')->name('schedules.')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('index');
            Route::get('/create', [ScheduleController::class, 'create'])->name('create');
            Route::post('/', [ScheduleController::class, 'store'])->name('store');
            Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('edit');
            Route::post('/import', [ScheduleController::class, 'import'])->name('import');
            Route::delete('/{schedule}', [ScheduleController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('predictions')->name('predictions.')->group(function () {
            Route::get('/{schedule_no}', [PredictionController::class, 'edit'])->name('edit');
            Route::post('/', [PredictionController::class, 'update'])->name('update');
        });
        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/', [BlogController::class, 'store'])->name('store');
            Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::put('/{blog}', [BlogController::class, 'update'])->name('update');
            Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('destroy');
            Route::post('/{blog}/sections', [BlogController::class, 'updateSections'])->name('sections.update');
            Route::post('/{blog}/upload-image', [BlogController::class, 'uploadImage'])->name('image.upload');
        });
    });
});
