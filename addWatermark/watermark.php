<?php

const IMAGE_CORNERS = ["TOP_LEFT", "TOP_RIGHT", "BOTTOM_LEFT", "BOTTOM_RIGHT"];

/**
 * The watermark will be resized to have the width equal to 15% of the image
 *
 * @param Imagick $image
 * @param Imagick $watermark
 * @return Imagick
 * @throws ImagickException
 */
function resizeWatermark(Imagick $image, Imagick $watermark): Imagick
{
    $imageWidth = $image->getImageWidth();

    $newWatermarkWidth = 0.15 * $imageWidth;
    $watermark->scaleImage($newWatermarkWidth, 0);

    return $watermark;

}

/**
 *
 *
 * @param Imagick $image
 * @param Imagick $watermark
 * @return array
 */
function computeRandomWatermarkCoordinates(Imagick $image, Imagick $watermark): array
{
    $randomCornerIndex = mt_rand(0, 3);
    $cornerPosition = IMAGE_CORNERS[$randomCornerIndex];

    switch ($cornerPosition) {

        case 'TOP_LEFT':
            $xCoordinate = 0;
            $yCoordinate = 0;
            break;
        case 'TOP_RIGHT':
            $xCoordinate = $image->getImageWidth() - $watermark->getImageWidth();
            $yCoordinate = 0;
            break;
        case 'BOTTOM_LEFT':
            $xCoordinate = 0;
            $yCoordinate = $image->getImageHeight() - $watermark->getImageHeight();
            break;
        case 'BOTTOM_RIGHT':
            $xCoordinate = $image->getImageWidth() - $watermark->getImageWidth();
            $yCoordinate = $image->getImageHeight() - $watermark->getImageHeight();
            break;
        default:
            $xCoordinate = $image->getImageWidth() - $watermark->getImageWidth();
            $yCoordinate = $image->getImageHeight() - $watermark->getImageHeight();

    }

    return ['x' => $xCoordinate, 'y' => $yCoordinate];
}

/**
 * @param array $payload
 * @return array
 * @throws ImagickException
 */
function addWatermarkToImage(array $payload): array
{

    if (!canExecuteFunction(WATERMARK, $payload)) {
        return $payload;
    }

    $watermark = new Imagick($payload[WATERMARK]);

    $resizedWatermark = resizeWatermark($payload[IMAGE], $watermark);
    $resizedWatermark->setImageOpacity(0.4);

    $coordinates = computeRandomWatermarkCoordinates($payload[IMAGE], $resizedWatermark);

    /**
     * @var Imagick $image
     */
    $image = $payload[IMAGE];
    $image->compositeImage($resizedWatermark, imagick::COMPOSITE_OVER, $coordinates['x'], $coordinates['y']);

    $payload[IMAGE] = $image;

    return $payload;
}