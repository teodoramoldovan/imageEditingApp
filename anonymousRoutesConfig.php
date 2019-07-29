<?php
return [
    '/' => [
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'showProducts'
    ],
    '/user/login' => [
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'login'
    ],
    '/user/loginPost' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'loginPost'
    ] ,
    '/user/register' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'register'
    ] ,
    '/user/registerPost' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'registerPost'
    ] ,
    '/product/show'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'showProduct'
    ],

];


