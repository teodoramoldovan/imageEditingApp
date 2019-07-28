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
    '/user/profile' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'showProfile'
    ] ,
    '/user/logout' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'logout'
    ] ,
    '/user/register' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'register'
    ] ,
    '/user/registerPost' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'registerPost'
    ] ,

];


