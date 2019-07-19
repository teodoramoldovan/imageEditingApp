<?php

/**
 * @param array $payload contains option after parsing
 * @return bool
 */
function isHelp(array $payload): bool
{
    if ($payload[HELP] == true) {
        return 1;
    }
    return 0;
}