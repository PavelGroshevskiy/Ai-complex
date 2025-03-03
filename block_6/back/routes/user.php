<?php

use App\Http\Controllers\api\v1\Post\IndexController;
use App\Http\Controllers\api\v1\Post\DeleteController;
use App\Http\Controllers\api\v1\Post\ShowController;
use App\Http\Controllers\api\v1\Post\StoreController;
use App\Http\Controllers\api\v1\Post\UpdateController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::prefix('user')
    ->middleware('auth')
    ->name('user.posts')->group(
        function () {
            Route::redirect('/', '/api/v1/user/posts')->name('user');
            Route::get('/posts', IndexController::class)->name('index');
            Route::post('/posts', StoreController::class)->name('store');
            Route::get('/posts/{post}', ShowController::class)->name('show');
            Route::patch('/posts/{post}', UpdateController::class)->name('update');
            Route::delete('/posts/{post}', DeleteController::class)->name('delete');
        }
    );
