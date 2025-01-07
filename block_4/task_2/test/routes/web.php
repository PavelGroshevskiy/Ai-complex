<?php

use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

// Route::controller(TasksController::class)->group(
//     function () {
//         Route::get('tasks/create', 'create')->name('create');
//         Route::post('tasks', 'store')->name('store');
//     }
// );

Route::resource('tasks', TasksController::class);


//  Контроллеры групп маршрутов
// Route::controller(IndexController::class)->group(
//     function () {
//         Route::get('/', 'index');
//         Route::get('{id}', 'show');
// }
//     );

// Запасные маршруты
// Route::fallback(
//     function () {

//     }
// );
