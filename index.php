<?php
require 'vendor/autoload.php';

use ShareMyArt\Controller\FrontController;

$routesConfiguration = include 'routesConfig.php';

$frontController = new FrontController($routesConfiguration);
$frontController->dispatch($_SERVER['REQUEST_URI']);
