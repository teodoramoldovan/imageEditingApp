<?php

const HELP_FILE_NAME = "imageEditProject/output/help.txt";

function showHelp(): void
{
    echo file_get_contents(HELP_FILE_NAME);
}

function showErrors(string $errors): void
{
    echo $errors;
}

function showSuccess(string $outputPath): void
{
    echo "SUCCESS. The processed image can be found here: " . $outputPath . PHP_EOL;
}