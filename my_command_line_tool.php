<?php
require_once "input/cli.php";
require_once "loadImage/loadImage.php";
require_once "saveImage/saveImage.php";
$payload1=readCommandLineInput($argv);
$payload2=readImage($payload1);
saveProcessedImage($payload2);