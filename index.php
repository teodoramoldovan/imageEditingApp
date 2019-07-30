<?php
require 'vendor/autoload.php';

use ShareMyArt\Controller\FrontController;

$anonymousRoutesConfiguration = include 'configurations/anonymousRoutesConfig.php';
$loggedInRoutesConfiguration = include 'configurations/loggedInRoutesConfig.php';

$frontController = new FrontController(
                                    $anonymousRoutesConfiguration,
                                    $loggedInRoutesConfiguration
                    );
$frontController->dispatch($_SERVER['REQUEST_URI']);
