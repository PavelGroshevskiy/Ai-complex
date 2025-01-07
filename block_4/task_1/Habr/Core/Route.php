<?php

class Route
{
    public static function start()
    {
        $init_controller= 'MainController';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        include 'Controllers/' . $init_controller . '.php'; 

        $controller = new $init_controller();
        $controller->action();

    }


}