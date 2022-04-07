<?php

namespace Application\Core;

class View
{
    public $path;

    public $route;

    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        ob_start();
        if (file_exists('Application/views/' . $this->path . '.php')) {
            require 'Application/views/' . $this->path . '.php';
            $content = ob_get_contents();
            require 'Application/views/layouts/' . $this->layout . '.php';
        } else {
            echo 'Вид не найден ' . $this->path;
        }
    }

    public function redirect($url)
    {
        header('location: '.$url);
        exit;
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        $path =  'Application/Views/errors/' . $code . '.php';
        if(file_exists($path)) {
            require $path;
        }
        exit;
    }

    public function message($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }
}