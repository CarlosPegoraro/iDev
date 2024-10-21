<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FormationController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Middleware\ValidateSessionToken;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => ValidateSessionToken::class], static function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/teacher', TeacherController::class);
    Route::resource('/formation', FormationController::class);
    Route::resource('/lesson', FormationController::class);
});
