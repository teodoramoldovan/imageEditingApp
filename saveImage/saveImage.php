<?php

function saveProcessedImage($infoToSave)
{
    $outputFilePath=$infoToSave[OUTPUT_FILE];
    /** @var Imagick $image */
    $image=$infoToSave[IMAGE];
    $image->writeImage($outputFilePath);

    return $outputFilePath;
}
