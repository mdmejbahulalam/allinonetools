<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ToolController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/search', SearchController::class);
Route::get('/tools', [ToolController::class, 'index']);
Route::get('/tools/{slug}', [ToolController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);
