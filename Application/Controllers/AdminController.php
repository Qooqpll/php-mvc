<?php

namespace Application\Controllers;

use Application\Core\Controller;

class AdminController extends Controller
{

    public function registerAction()
    {

        //session_destroy();

        $this->setLayout();
        $this->view->render('admin');

        //$this->initSession();

        if ($this->registerValidate()) {
            $_SESSION['data_user'] = $_POST;
            if($this->validatePassword($_SESSION['data_user']['password'], $_SESSION['data_user']['confirm_password'])) {
                if($this->model->validateUsername($_SESSION['data_user']['username'])) {
                    $this->model->createUser();
                    $this->view->redirect('panel');
                } else {
                    $_SESSION['message'] = 'логин занят';
                }

            } else {
                $_SESSION['message'] = 'пароли не совпадают';
            }
        } else {
            $_SESSION['message'] = 'поля не заполнены';
        }
    }

    public function loginAction()
    {
        //session_destroy();

        $this->setLayout();
        $this->view->render('admin');

        //$this->initSession();

        if (!empty($_POST)) {
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['password'] = $_POST['password'];
            var_dump($_SESSION);

            var_dump($this->model->checkAuth());
            if($this->model->checkAuth() ) {
                $this->view->redirect('panel');
            } else {
                $_SESSION['message'] = 'логин или пароль неверный';
            }

        }

    }

    public function logoutAction()
    {

    }

    public function panelAction()
    {
        $this->setLayout();
        $this->view->render('Панель админа');
    }

    private function setLayout()
    {
        $this->view->layout = 'admin';
    }

    //функция управления на основе временных меток
    public function my_session_start()
    {
        session_start();
        // Не разрешать использование слишком старых идентификаторов сессии
        if (!empty($_SESSION['deleted_time']) && $_SESSION['deleted_time'] < time() - 180) {
            session_destroy();
            session_start();
        }
    }

    //функция генерации id сессии
    public function session_regenerate_id()
    {
        // Вызов session_create_id() пока сессия активна, чтобы
        // удостовериться в отсутствии коллизий.
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $newid = session_create_id();
        // Установка временной метки удаления. Данные активной сессии не должны удаляться сразу же.
        $_SESSION['deleted_time'] = time();
        // Завершение сессии
        session_commit();
        session_id($newid);
        // Старт сессии с пользовательским идентификатором
        session_start();
    }

    //проверка полей отличительных от null
    private function registerValidate()
    {
        return !empty($_POST['username']) && !empty($_POST['first_name'])
            && !empty($_POST['last_name']) && !empty($_POST['email'])
            && !empty($_POST['password']) && !empty($_POST['confirm_password']);
    }

    //Проверка пароля и создание шифра md5
    private function validatePassword($password, $confirmPassword)
    {
        if ($password === $confirmPassword) {
            $_SESSION['encrypted_password'] = md5($password);

            return true;
        }
        $_SESSION['message'] = 'пароли не совпадают';

        return false;
    }

    //инициальзиация сессии
    public function initSession()
    {
        //старт сессии
        /*ini_set('session.use_strict_mode', 1);
        $this->my_session_start();
        $this->session_regenerate_id();*/
    }

    //Создание id админа
    public function createAdminId()
    {
        $newid = session_create_id();
        session_id($newid);
        $_SESSION['admin']['id'] = session_id();
    }

    //устанавилвает данные об активном пользователе
    public function isActiveUser()
    {

    }

}