<?php
return [
    '/' => [
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'showProducts',
        'arguments' => false
    ],
    '/user/login' => [
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'login',
        'arguments' => false
    ],
    '/user/loginPost' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'loginPost',
        'arguments' => false
    ] ,
    '/user/register' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'register',
        'arguments' => false
    ] ,
    '/user/registerPost' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'registerPost',
        'arguments' => false
    ] ,
    '/product/show'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'showProduct',
        'arguments' => true
    ],

];


