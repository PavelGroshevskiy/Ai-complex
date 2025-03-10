<?php

namespace Controllers;

use Decorators\DecoratorFactory;
use Views\ViewsFactory;

class Controller
{
    public string $path;
    public Router $router;
    public object $model;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->router = Router::parse($path);


        $class = 'Models\\' . ucfirst($this->router->model);


        $this->model = new $class;


        if ($this->router->id) {
            $this->model = $this->model->collection[$this->router->id];
        }
    }

    public function render() : string
    {
        $class = get_class($this->model);


        $class = substr($class, strrpos($class, '\\') + 1);

        $decorator = DecoratorFactory::create(
            $class,
            $this->model
        );

        $view = ViewsFactory::create(
            $this->router->ext,
            $class,
            $decorator
        );

        return $view->render();
    }
}