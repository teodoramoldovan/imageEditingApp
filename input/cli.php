<?php
const ARGUMENTS_PATTERN = "/(?<index>-*\w+-?\w+)=?(?<value>[\/?\w]+:?\/*\.?\w*)?/";
const NO_PATH_PATTERN = "/^\w+\.[jpg|png|jpeg]+/";
const PREDEFINED_INPUT_FOLDER = "inputImages/";
const PREDEFINED_OUTPUT_FOLDER = "outputImages/";


function isPathGiven(string $imagePath)
{
    if (preg_match(NO_PATH_PATTERN, $imagePath, $matches) === 1) {
        return false;
    }
    return true;
}

function parseCommandLineInput(array $argv): array
{
    $keys = [INPUT_FILE, OUTPUT_FILE, WIDTH, HEIGHT, FORMAT, WATERMARK, HELP];
    $payload = array_fill_keys($keys, '');

    array_shift($argv);

    foreach ($argv as $argument) {
        preg_match(ARGUMENTS_PATTERN, $argument, $matches);
        $payload[$matches['index']] = ($matches['index'] != HELP) ? $matches['value'] : true;

    }

    if (!isPathGiven($payload[INPUT_FILE])) {
        $payload[INPUT_FILE] = PREDEFINED_INPUT_FOLDER . $payload[INPUT_FILE];
    }
    if (!isPathGiven($payload[OUTPUT_FILE])) {

        $payload[OUTPUT_FILE] = PREDEFINED_OUTPUT_FOLDER . $payload[OUTPUT_FILE];
    }
    if (!isPathGiven($payload[WATERMARK])) {
        $payload[WATERMARK] = PREDEFINED_INPUT_FOLDER . $payload[WATERMARK];
    }
    $payload[INPUT_FILE]=(!realpath($payload[INPUT_FILE])) ? $payload[INPUT_FILE] : realpath($payload[INPUT_FILE]);
    $payload[OUTPUT_FILE]=(!realpath($payload[OUTPUT_FILE])) ? $payload[OUTPUT_FILE] : realpath($payload[OUTPUT_FILE]);
    $payload[WATERMARK] = (!realpath($payload[WATERMARK])) ? $payload[WATERMARK] : realpath($payload[WATERMARK]);

    //var_dump($payload[WATERMARK]);

    return $payload;
}