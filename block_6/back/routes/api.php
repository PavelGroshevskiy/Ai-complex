<?php

use App\Http\Controllers\api\v1\User\LoginController;
use App\Http\Controllers\api\v1\User\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get(
    '/user', function (Request $request) {
        return $request->user();
    }
)->middleware('auth:sanctum');

// Route::prefix('v1')->group(
//     function () {
//         Route::apiResource('posts', PostController::class);
//     }
// );


Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [RegisterController::class, 'register']);


