<?php

namespace Modules\Articles;

use System\Contracts\IModule;
use System\Contracts\IRouter;
use Modules\Articles\Controllers\Index as ArticleController;

class Module implements IModule
{
    public function registerRoutes(IRouter $router) : void
    {
        $router->addRoute('', ArticleController::class);
        $router->addRoute('article/1', ArticleController::class, 'item');
        $router->addRoute('article/2', ArticleController::class, 'item');
        $router->addRoute('article/3', ArticleController::class, 'item');
    }
}
