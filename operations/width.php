<?php

require_once "utils/utilityFunctions.php";

function resizeByWidth(array $payload):array
{

    if(!canExecuteFunction(WIDTH,$payload)){
        return $payload;
    }

    $newWidthAsString=$payload[WIDTH];
    $newWidth=castStringToInt($newWidthAsString);

    /** @var Imagick $image */
    $image=$payload[IMAGE];
    $image->scaleImage($newWidth,0);
    $payload[IMAGE]=$image;
    return $payload;

}
