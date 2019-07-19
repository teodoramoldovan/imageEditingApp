<?php

require_once "input/cli.php";
require_once "loadImage/loadImage.php";
require_once "saveImage/saveImage.php";
require_once "operations/width.php";
require_once "operations/height.php";
require_once  "operations/ratio.php";
require_once "addWatermark/watermark.php";
require_once "isHelp/isHelp.php";
require_once "output/output.php";
require_once "validation/validation.php";
require_once "error/error.php";

const INPUT_FILE="--input-file";
const OUTPUT_FILE="--output-file";
const WIDTH="--width";
const HEIGHT="--height";
const FORMAT="--format";
const WATERMARK="--watermark";
const HELP="--help";
const IMAGE="--image";

$payload1=parseCommandLineInput($argv);

if(isHelp($payload1)){
    showHelp();
    exit();
}

$payload9=validateInput($payload1);

if(!empty($payload9)){
    $errorString=convertArrayOfErrorsToString($payload9);
    showErrors($errorString);
    exit();
}

$payload2=readImage($payload1);

$payload3Intermediate=resizeByWidth($payload2);
$payload3Intermediate=resizeByHeight($payload3Intermediate);
$payload3=resizeByFormat($payload3Intermediate);

$payload4=addWatermarkToImage($payload3);

$payload5=saveProcessedImage($payload4);

showSucces($payload5);
