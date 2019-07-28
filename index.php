
<?php
require 'vendor/autoload.php';
use ShareMyArt\Controller\ProductController;

const URL_MAP=[
    '/' => "ShareMyArt\Controller\ProductController::showProducts",
    '/user/login'=>"ShareMyArt\Controller\UserController::login",
    '/user/loginPost'=>"ShareMyArt\Controller\UserController::loginPost",
    '/user/profile'=>"ShareMyArt\Controller\UserController::showProfile"

];
$url=$_SERVER['REQUEST_URI'];
call_user_func(URL_MAP[$url]);