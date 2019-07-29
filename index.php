<?php
require 'vendor/autoload.php';

use ShareMyArt\Controller\FrontController;

$anonymousRoutesConfiguration = include 'anonymousRoutesConfig.php';
$loggedInRoutesConfiguration = include 'loggedInRoutesConfig.php';

$frontController = new FrontController(
                                    $anonymousRoutesConfiguration,
                                    $loggedInRoutesConfiguration
                    );
$frontController->dispatch($_SERVER['REQUEST_URI']);
