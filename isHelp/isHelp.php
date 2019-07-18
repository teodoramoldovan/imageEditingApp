<?php

function isHelp($payload)
{
    if ($payload[HELP] == true) {
        return 1;
    }
    return 0;
}