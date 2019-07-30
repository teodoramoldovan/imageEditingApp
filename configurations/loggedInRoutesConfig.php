<?php
return [

    '/user/logout' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'logout',
        'arguments' => false
    ] ,
    '/product/upload'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'uploadProduct',
        'arguments' => false
    ],
    '/product/uploadPost'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'uploadProductPost',
        'arguments' => false
    ],
    '/product/buy'=>[
        'className'=>'\ShareMyArt\Controller\ProductController',
        'methodName'=>'buyProduct',
        'arguments' => false//for now
    ],
    '/user/myUploads' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'showUploads',
        'arguments' => false
    ] ,
    '/user/myOrders' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'showOrders',
        'arguments' => false
    ] ,

];


