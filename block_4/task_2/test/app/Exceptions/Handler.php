<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Список исключений, которые не должны логироваться.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Список входных данных, которые никогда не должны передаваться в исключения.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Регистрируйте обратные вызовы для обработки исключений.
     *
     * @return void
     */
    public function register() : void
    {
        $this->reportable(
            function (MyCustomExeption $e) {
                //
            }
        );

        $this->renderable(
            function (NotFoundHttpException $e, Request $request) {
                if ($request->isJson()) {
                    return Route::respondWithRoute('404');
                }
            }
        );
    }
}
