<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JsonPlaceholderApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('web')->group(function () {
    Route::get('/users', [JsonPlaceholderApiController::class, 'getUsers']);
    Route::get('/users/{userId}', [JsonPlaceholderApiController::class, 'getUserById']);
    Route::get('/users/{userId}/posts', [JsonPlaceholderApiController::class, 'getUserPosts']);
    Route::get('/users/{userId}/todos', [JsonPlaceholderApiController::class, 'getUserTodos']);
    Route::post('/posts', [JsonPlaceholderApiController::class, 'addPost']);
    Route::put('/posts/{postId}', [JsonPlaceholderApiController::class, 'updatePost']);
    Route::delete('/posts/{postId}', [JsonPlaceholderApiController::class, 'deletePost']);
});


