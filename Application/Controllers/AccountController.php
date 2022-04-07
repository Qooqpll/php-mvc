<?php

namespace Application\Controllers;

use Application\Core\Controller;

class AccountController extends Controller
{
    public function loginAction()
    {

        //$this->view->render('Вход');
    }

    public function registerAction()
    {
        $this->view->render('Регистрация');
    }

    public function adminAction()
    {
        $this->view->layout = 'admin';
        $this->view->render('admin');
    }

}