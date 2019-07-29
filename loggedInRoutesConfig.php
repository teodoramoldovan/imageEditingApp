<?php
return [

    '/user/logout' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'logout'
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
    '/user/myUploads' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'showUploads'
    ] ,
    '/user/myOrders' =>[
        'className'=>'\ShareMyArt\Controller\UserController',
        'methodName'=>'showOrders'
    ] ,

];


