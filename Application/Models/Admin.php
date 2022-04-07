<?php

namespace Application\Models;

use Application\Core\Model;

class Admin extends Model
{
    public function createUser()
    {
        $password = $_SESSION['encrypted_password'];
        $lastLogin = $this->lastLogin();
        $username = $_SESSION['data_user']['username'];
        $firstName = $_SESSION['data_user']['first_name'];
        $lastName = $_SESSION['data_user']['last_name'];
        $email = $_SESSION['data_user']['email'];

            $this->db->insert("INSERT INTO `admin_user` (`id`, `password`, `last_login`, `is_superuser`, 
`username`, `first_name`, `last_name`, `email`, `is_staff`, `is_active`, `data_joined`) 
VALUES (NULL, '$password', '$lastLogin', '1', '$username', '$firstName', '$lastName', '$email', '1', '1', '$lastLogin');");

    }

    public function authUser()
    {
        
    }

    public function lastLogin()
    {
        return date("Y-m-d H:i:s");
    }

    public function checkAuth()
    {
        $password = md5($_SESSION['password']);
        $login = $_SESSION['login'];
        $data = $this->db->row("SELECT password, username FROM `admin_user` WHERE password='$password' AND username='$login'");

        if(count($data) > 0) {

            return $this->checkAuthLogin($data) && $this->checkAuthPassword($password, $data[0]['password']);
        }
    }

    public function checkAuthLogin($users)
    {
        return count($users[0]) > 1 ? true : false;
    }

    public function checkAuthPassword($password, $userPassword)
    {
        return $password == $userPassword;
    }

    public function validateUsername($username)
    {
        $data = $this->db->row("SELECT * FROM `admin_user` WHERE `username` LIKE '$username'");
        return count($data) == 0 ? true : false;
    }
}