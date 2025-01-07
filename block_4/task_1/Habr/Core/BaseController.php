<?php

namespace Controller;

use Core\View;

abstract class BaseController
{
    public View $view;
    abstract public function action();

    function __construct()
    {
            $this->view = new View();
    }
}