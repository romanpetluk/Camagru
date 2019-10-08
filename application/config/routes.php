 <?php

    return [

        //MainController
        '' => [
            'controller' => 'main',
            'action' => 'index',
        ],

//        '' => [
//            'controller' => 'photo',
//            'action' => 'gallery',
//        ],

        //AccountController
        'account/login' => [
            'controller' => 'account',
            'action' => 'login',
            ],

        'account/logout' => [
            'controller' => 'account',
            'action' => 'logout',
        ],

        'account/register' => [
            'controller' => 'account',
            'action' => 'register',
        ],

        'account/recovery' => [
            'controller' => 'account',
            'action' => 'recovery',
        ],

        'account/confirm/[a-zA-Z0-9]{30}' => [
            'controller' => 'account',
            'action' => 'confirm',
        ],

        'account/reset/[a-zA-Z0-9]{30}' => [
            'controller' => 'account',
            'action' => 'reset',
        ],

        'account/profile' => [
            'controller' => 'account',
            'action' => 'profile',
        ],

        //PhotoController
        'photo/gallery/([0-9]+)' => [
//        'photo/gallery' => [
            'controller' => 'photo',
            'action' => 'gallery',
        ],

        'photo/selfie' => [
            'controller' => 'photo',
            'action' => 'selfie',
        ],

    ];