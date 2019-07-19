<?php

/**
 * @param string $functionName
 * @param array $payload
 * @return bool
 */
function canExecuteFunction(string $functionName, array $payload): bool
{
    return !empty($payload[$functionName]);
}



