<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
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
        Route::get('/', [TeamController::class, 'index'])->name('top');
        Route::get('/teams', [TeamController::class, 'index'])->name('team.index');
        Route::get('/setting', [AdminController::class, 'edit'])->name('setting');
        Route::post('/setting', [AdminController::class, 'update'])->name('setting.update');
    });
});

