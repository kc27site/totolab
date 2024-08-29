<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\PredictionController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\RedirectIfNotAdmin;

Route::get('/', function () {
    return view('welcome');
});

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
    });
});
