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
        $router->addRoute('article/4', ArticleController::class, 'item');
        $router->addRoute('article/5', ArticleController::class, 'item');
        $router->addRoute('article/6', ArticleController::class, 'item');
        $router->addRoute('article/7', ArticleController::class, 'item');
        $router->addRoute('article/8', ArticleController::class, 'item');
        $router->addRoute('article/9', ArticleController::class, 'item');
        $router->addRoute('article/10', ArticleController::class, 'item');
        $router->addRoute('article/create', ArticleController::class, 'create');
    }
}
