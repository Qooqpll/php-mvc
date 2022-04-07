<?php

namespace Application\Core;

use Application\Core\View;

abstract class Controller
{

    public $route;

    public $view;

    public $model;

    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        if(!$this->checkAcl()) {
            View::errorCode(403);
        }

        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }
    }

    public function checkAcl()
    {
        $path = 'Application/acl/' . $this->route['controller'] . '.php';
        if (file_exists($path)) {
            $this->acl = require $path;
            if ($this->isAcl('all')) {

                return true;

            } elseif(isset($_SESSION['authorize']['id']) AND $this->isAcl('authorize')) {

                return true;

            } elseif(!isset($_SESSION['authorize']['id']) AND $this->isAcl('guest')) {

                return true;

            } elseif(isset($_SESSION['admin']['id']) AND $this->isAcl('admin')) {

                return true;

            }

         return false;
        }
    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}