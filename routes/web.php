<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;

Route::get('/', [ToolController::class, 'index'])->name('home');
Route::get('/category/{slug}', [ToolController::class, 'category'])->name('category');
Route::get('/{slug}', [ToolController::class, 'show'])->name('tool.show');
