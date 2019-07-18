<?php

function canExecuteFunction(string $functionName, array $payload )
{
    return !empty($payload[$functionName]);
}

function castStringToInt(string $value):int
{
    return (int)$value;
}

