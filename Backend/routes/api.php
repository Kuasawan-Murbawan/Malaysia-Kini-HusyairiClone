<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\StoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/comments/{comment}', [CommentController::class, 'show']);
Route::get('/news/{story}/comments', [CommentController::class, 'storyComments']);

Route::get('/news/{story}', [StoryController::class, 'show']);
Route::get('/news', [StoryController::class, 'index']);
