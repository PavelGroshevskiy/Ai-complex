<?php

spl_autoload_register();

use Controllers\Controller;

//$obj = new Controller('users.rss');
$obj = new Controller('users/1.html');
echo $obj->render();