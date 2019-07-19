<?php

require_once "utils/utilityFunctions.php";

/**
 * Will resize the image according to the initial ratio and the new specified height
 *
 * @param array $payload contains the opened image and the options given as input
 * @return array contains same array, but with the resized image
 * @throws ImagickException
 */
function resizeByHeight(array $payload): array
{
    if (!canExecuteFunction(HEIGHT, $payload)) {
        return $payload;
    }

    $newHeightAsString = $payload[HEIGHT];
    $newHeight = (int)$newHeightAsString;

    /** @var Imagick $image */
    $image = $payload[IMAGE];
    $image->scaleImage(0, $newHeight);

    $payload[IMAGE] = $image;

    return $payload;

}
