<?php

/*
 4. MVC, модели данных, основы архитектуры.
MVC паттерн. Взаимодействие компонентов MVC.
Получение моделей данных, работа с БД, принципы разделения ответственности в классах моделей, нейминг моделей.
https://habrahabr.ru/post/150267/
PDO, ORM, Data mapper, active record.
https://habrahabr.ru/post/198450/
Основы работы с mysql: создание базы данных, пользователей, таблиц
mysql: запросы select и delete
mysql: запрос insert и replace
mysql: запрос update
MySQL инъекции, безопасность запросов, экранирование.
Принципы использования сервисов, хелперов, распределение функций по классам.
Шаблонизаторы

Задания для самостоятельной проверки пройденного:
    ⁃    Написать свой mini-MVC (такие же формы, get, post) https://habr.com/ru/post/150267/ 
    ⁃    Поднять проект на фреймворке Laravel. Реализовать гостевую страницу. Список постов и форма добавления.
 Использовать возможности фреймворка - модели, сервисы, помощники. https://laravel.com/docs/8.x/installation 
 */


require_once 'init.php';

use System\Exceptions\Exc404;
use System\Router;
use System\ModulesDispatcher;

use Modules\Articles\Module as Articles;

const BASE_URL = '/';

try{    
    $modules = new ModulesDispatcher();
    $modules->add(new Articles());
    $router = new Router(BASE_URL);

    $modules->registerRoutes($router);
    /*      */

    $uri = $_SERVER['REQUEST_URI'];
    $activeRoute = $router->resolvePath($uri);

    $c = $activeRoute['controller'];
    $m = $activeRoute['method'];

    $c->$m();
    $html = $c->render();
    echo $html;
}
catch(Exc404 $e){
    echo '404'; 
}
catch(Throwable $e){
    echo 'nice show error - ' . $e->getMessage();
}


    // echo '<pre>';
    // print_r($activeRoute);
    // echo '</pre>';
