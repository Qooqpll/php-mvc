<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login'
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register'
    ],

    //Admin controller
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login'
    ],

    'admin/register' => [
        'controller' => 'admin',
        'action' => 'register'
    ],

    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout'
    ],

    'admin/panel' => [
        'controller' => 'admin',
        'action' => 'panel'
    ],
];