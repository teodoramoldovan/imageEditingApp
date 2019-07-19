<?php

require_once "utils/utilityFunctions.php";

/**
 * Will resize the image according to the initial ratio and the new specified width
 *
 * @param array $payload contains the opened image and the options given as input
 * @return array contains same array, but with the resized image
 * @throws ImagickException
 */
function resizeByWidth(array $payload): array
{

    if (!canExecuteFunction(WIDTH, $payload)) {
        return $payload;
    }

    $newWidthAsString = $payload[WIDTH];
    $newWidth = (int)$newWidthAsString;

    /** @var Imagick $image */
    $image = $payload[IMAGE];
    $image->scaleImage($newWidth, 0);

    $payload[IMAGE] = $image;

    return $payload;

}
