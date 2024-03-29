<?php

/**
 * @param array $errorPayload
 * @return string
 */
function convertArrayOfErrorsToString(array $errorPayload): string
{
    $errorString = PHP_EOL . 'ERRORS' . PHP_EOL;

    foreach ($errorPayload as $key => $error) {
        $errorNumber = $key + 1;
        $errorString .= $errorNumber . '. ' . $error . PHP_EOL;

    }

    return $errorString;
}