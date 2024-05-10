<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('books', BookController::class)->except('index');
    Route::post('books/{book}/favorite', [BookController::class, 'toggleFavorite']);
});
Route::get('/v1/books/filter', [BookController::class, 'filterBooks']);
Route::get('/v1/books', [BookController::class, 'index']);
Route::post('/signup', [AuthController::class, 'signUp']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
