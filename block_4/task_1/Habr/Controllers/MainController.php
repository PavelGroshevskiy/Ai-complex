<?php

use Controller\BaseController;

class MainController extends BaseController
{
    public function action()
    {
        
        $this->view->generate('MainTemplate.php');
    }
}

