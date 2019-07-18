<?php

require_once "utils/utilityFunctions.php";

function resizeByHeight(array $payload):array
{

    if(!canExecuteFunction(HEIGHT,$payload)){
        return $payload;
    }

    $newHeightAsString=$payload[HEIGHT];
    $newHeight=castStringToInt($newHeightAsString);

    /** @var Imagick $image */
    $image=$payload[IMAGE];
    $image->scaleImage(0,$newHeight);
    $payload[IMAGE]=$image;
    return $payload;

}
