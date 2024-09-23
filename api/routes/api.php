<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\ValidateSessionToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => ValidateSessionToken::class], static function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
