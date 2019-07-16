<?php
function saveProcessedImage($infoToSave)
{
    $outputFilePath=$infoToSave['output-file'];
    /**
     * @var Imagick $image
     */
    $image=$infoToSave['image'];
    $image->writeImage($outputFilePath);
}
