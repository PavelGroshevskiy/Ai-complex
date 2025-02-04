<?php

use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::get(
    '/test', function (Illuminate\Http\Request $request) {
        return [
        'method' => $request->method(),
        'url' => $request->url(),
        'path' => $request->path(),
        'fullUrl' => $request->fullUrl(),
        'ip' => $request->ip(),
        'userAgent' => $request->userAgent(),
        'header' => $request->header(),
        ];
    }
);


Route::resource('posts', PostsController::class);


Route::fallback(
    function () {
        return redirect('/');
    }
);

//  Контроллеры групп маршрутов
// Route::controller(IndexController::class)->group(
//     function () {
//         Route::get('/', 'index');
//         Route::get('{id}', 'show');
// }
//     );

// Запасные маршруты



