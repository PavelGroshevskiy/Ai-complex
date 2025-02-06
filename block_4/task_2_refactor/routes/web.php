<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\DefaultController;
use App\Http\Controllers\Post\DeleteController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\UpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::group(
    ['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index']);

    }
);

Route::prefix('posts')->name('posts.')->group(
    function () {

        Route::get('/default', [DefaultController::class, 'index'])->name('default');
        Route::get('/', IndexController::class)->name('index');
        Route::get('/create', CreateController::class)->name('create');
        Route::post('/create', StoreController::class)->name('store');
        Route::get('/{post}', ShowController::class)->name('show');
        Route::get('/{post}/edit', EditController::class)->name('edit');
        Route::patch('/{post}', UpdateController::class)->name('update');
        Route::delete('/{post}', DeleteController::class)->name('delete');
    }
);



