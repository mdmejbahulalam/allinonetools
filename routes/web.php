<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ToolController as AdminToolController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

// Admin Auth Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('admin.login')->middleware('guest:admin');
    Route::post('login', [AuthController::class, 'login'])->middleware('guest:admin');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
});

// Admin Protected Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('admin.dashboard');
    Route::resource('tools', AdminToolController::class, ['as' => 'admin']);
    Route::resource('categories', AdminCategoryController::class, ['as' => 'admin']);
});

// Public Routes
Route::get('/', [ToolController::class, 'index'])->name('home');
Route::get('/category/{slug}', [ToolController::class, 'category'])->name('category');
Route::get('/{slug}', [ToolController::class, 'show'])->name('tool.show');
