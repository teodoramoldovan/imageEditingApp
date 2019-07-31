<?php

require_once "imageEditProject/utils/utilityFunctions.php";

/**
 * Decides which one between width and height will not change when resizing by format
 * When no height or width options were specified, by default the initial width will be kept
 *
 * @param array $payload contains the opened image and the options given as input
 * @return array contains the fixed option used and its value
 */
function getFixedParameterForFormat(array $payload): array
{
    if (!empty($payload[WIDTH])) {
        return [WIDTH => (int)$payload[WIDTH]];
    }
    if (!empty($payload[HEIGHT])) {
        return [HEIGHT => (int)$payload[HEIGHT]];
    }

    /** @var Imagick $image */
    $image = $payload[IMAGE];

    return [WIDTH => $image->getImageWidth()];
}


/**
 * @param string $ratioString
 * @return array
 */
function getRatioParameters(string $ratioString): array
{
    [$width, $height] = explode(':', $ratioString);
    return ['ratioWidth' => (int)$width, 'ratioHeight' => (int)$height];

}

/**
 * Prepares payload for the next step
 *
 * @param array $payload
 * @return array
 */
function removeParametersFromOutputArray(array $payload): array
{
    unset($payload[WIDTH]);
    unset($payload[HEIGHT]);
    unset($payload[FORMAT]);
    unset($payload[HELP]);
    return $payload;
}


/**
 * @param array $payload
 * @return array
 * @throws ImagickException
 */
function resizeByFormat(array $payload): array
{

    if (!canExecuteFunction(FORMAT, $payload)) {
        $newPayload = removeParametersFromOutputArray($payload);
        return $newPayload;
    }

    $fixedParameter = getFixedParameterForFormat($payload);
    $ratioParameters = getRatioParameters($payload[FORMAT]);

    /** @var Imagick $image */
    $image = $payload[IMAGE];

    if (array_key_exists(WIDTH, $fixedParameter)) {
        $newHeight = $fixedParameter[WIDTH] * $ratioParameters['ratioHeight'] / $ratioParameters['ratioWidth'];
        $image->scaleImage($fixedParameter[WIDTH], $newHeight);
    }

    if (array_key_exists(HEIGHT, $fixedParameter)) {
        $newWidth = $fixedParameter[HEIGHT] * $ratioParameters['ratioWidth'] / $ratioParameters['ratioHeight'];
        $image->scaleImage($newWidth, $fixedParameter[HEIGHT]);
    }

    $payload[IMAGE] = $image;
    $newPayload = removeParametersFromOutputArray($payload);

    return $newPayload;

}