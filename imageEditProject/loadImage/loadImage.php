<?php

/**
 * @param array $payload contains parsed input after validation
 * @return array contains opened image instead of input file path
 * @throws ImagickException
 */
function readImage(array $payload): array
{
    $imagePath = $payload[INPUT_FILE];
    $image = new Imagick($imagePath);

    $payload = [IMAGE => $image] + $payload;

    return $payload;
}