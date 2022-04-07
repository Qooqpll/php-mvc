<?php

use Application\Core\Router;

//error_reporting(0);

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    $path .= '.php';
    if(file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router();

$router->run();