<?php

namespace Application\Controllers;

use Application\Core\Controller;

class MainController extends Controller
{

    public function indexAction()
    {

        $vars = ['data' => 'hello',];

        $this->view->render('Главная страница', $vars);
    }

}