<?php
require 'vendor/autoload.php';

const URL_MAP = [
    '/' => "ShareMyArt\Controller\ProductController::showProducts",
    '/user/login' => "ShareMyArt\Controller\UserController::login",
    '/user/loginPost' => "ShareMyArt\Controller\UserController::loginPost",
    '/user/profile' => "ShareMyArt\Controller\UserController::showProfile",
    '/user/logout' => "ShareMyArt\Controller\UserController::logout",

];

if (!isset($_SESSION)) {
    session_start();
}

$url = $_SERVER['REQUEST_URI'];
call_user_func(URL_MAP[$url]);