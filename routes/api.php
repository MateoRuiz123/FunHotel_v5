<?php

use App\Http\Controllers\api\UserApiController;
use App\Http\Controllers\api\ReservaApiController;
use Illuminate\Support\Facades\Route;

// Route::prefix('api')->group(function () {
//     Route::get('/users', [UserApiController::class, 'index']);
// });

Route::apiResource('users', UserApiController::class);
Route::apiResource('reservas', ReservaApiController::class);
// ruta api login
Route::post('users/login', [UserApiController::class, 'login'])->name('users.login');