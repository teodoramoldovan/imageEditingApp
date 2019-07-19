<?php

/**
 * @param array $payload contains path where to save the image and the image after processing
 * @return string file path where the image was saved
 */
function saveProcessedImage(array $payload): string
{
    $outputFilePath = $payload[OUTPUT_FILE];

    /** @var Imagick $image */
    $image = $payload[IMAGE];
    $image->writeImage($outputFilePath);

    return $outputFilePath;
}
