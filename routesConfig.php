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
    '/product/upload'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'uploadProduct'
    ],
    '/product/uploadPost'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'uploadProductPost'
    ],
    '/product/buy'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'buyProduct'
    ],
    '/product/show'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'showProduct'
    ],
    '/user/myUploads' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'showUploads'
    ] ,
    '/user/myOrders' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'showOrders'
    ] ,



];


