<?php
const VALID_PIXEL_VALUE_PATTERN = '/^\d+$/';
const VALID_FORMAT_VALUE_PATTERN = '/\d+:\d+/';
const VALID_EXTENSION_PATTERN = '/\.\w+/';
const VALID_EXTENSION_TYPES = ['.jpg', '.jpeg', '.png'];
const VALID_OPTION_TYPES =['--input-file', '--output-file', '--width', '--height', '--format', '--watermark', '--help'];
const IMAGE_NAME_PATTERN = "/(?<path>.*\/).*/";
const POSSIBLE_ERRORS = [
    'required' => "Options --input-file and --output-file are required",
    'input-path' => "Input file path is invalid. Entering an input file path is mandatory",
    'output-path' => "Output file path is invalid. Entering an output file path is mandatory",
    'watermark-path' => "Watermark file path is invalid",
    'width-value' => "The width value you entered is invalid. Width must be an integer",
    'height-value' => "The height value you entered is invalid. Height must be an integer",
    'format-value' => "The format value you entered is invalid. Format must be width:height",
    'input-extension' => "The extension for the input file is not accepted. Accepted extensions: .jpeg, .jpg, .png",
    'output-extension' => "The extension for the output file is not accepted. Accepted extensions: .jpeg, .jpg, .png",
    'watermark-extension' => "The extension for the watermark file is not accepted. Accepted extensions: .jpeg, .jpg, .png",
    'wrong-options' => "One or multiple options are incorrect. Use 'php my_command_line_tool.php --help' for a list of options",
    'input-mime-type' => "Given input path does not contain an image",
    'watermark-mime-type' => "Given watermark path does not contain an image",

];


function extractDirectoryPath(string $path): string
{
    preg_match(IMAGE_NAME_PATTERN, $path, $matches);
    return $matches['path'];
}

function validatePath(string $path): bool
{
    return file_exists($path);
}

function validatePixelInput(string $pixelValue): bool
{

    if (preg_match(VALID_PIXEL_VALUE_PATTERN, $pixelValue) === 1) {
        return true;
    }
    return false;
}

function validateFormatInput(string $formatValue): bool
{
    if (preg_match(VALID_FORMAT_VALUE_PATTERN, $formatValue) === 1) {
        return true;
    }
    return false;
}

function validateImageExtensions(string $path): bool
{
    preg_match(VALID_EXTENSION_PATTERN, $path, $matches);
    $match = $matches[0];
    if (in_array($match, VALID_EXTENSION_TYPES)) {
        return true;
    }
    return false;
}

function validateOptions(array $payload): bool
{

    foreach ($payload as $key => $value) {
        //var_dump($key);
        if (!in_array($key, VALID_OPTION_TYPES))

            return false;
    }
    return true;
}

function validateMimeType(string $imagePath): bool
{
    if (!validatePath($imagePath) ||  !validateImageExtensions($imagePath)) {
        return false;

    }
    $mimeType = mime_content_type($imagePath);
    if (strpos($mimeType, 'image') !== false) {
        return true;
    }
    return false;
}

function validateInputRequiredArguments($payload): bool
{
    if (empty($payload[INPUT_FILE]) || empty($payload[OUTPUT_FILE])) {
        return false;
    }
    return true;
}

function validateInput(array $payload): array
{

    $errors = [];
    //var_dump($payload);
    if (!validateOptions($payload)) {
        $errors[] = POSSIBLE_ERRORS['wrong-options'];
        return $errors;
    }


    if (!validateInputRequiredArguments($payload)) {
        $errors[] = POSSIBLE_ERRORS['required'];
        return $errors;
    }

    if (!validatePath($payload[INPUT_FILE])) {
        $errors[] = POSSIBLE_ERRORS['input-path'];
    }
    if (!validatePath(extractDirectoryPath($payload[OUTPUT_FILE]))) {

        $errors[] = POSSIBLE_ERRORS['output-path'];
    }

    if (!empty($payload[WATERMARK]) && !validatePath($payload[WATERMARK])) {

        $errors[] = POSSIBLE_ERRORS['watermark-path'];
    }

    if (!empty($payload[WIDTH]) && !validatePixelInput($payload[WIDTH])) {

        $errors[] = POSSIBLE_ERRORS['width-value'];
    }
    if (!empty($payload[HEIGHT]) && !validatePixelInput($payload[HEIGHT])) {
        $errors[] = POSSIBLE_ERRORS['height-value'];
    }

    if (!empty($payload[FORMAT]) && !validateFormatInput($payload[FORMAT])) {
        $errors[] = POSSIBLE_ERRORS['format-value'];
    }

    if (!validateImageExtensions($payload[INPUT_FILE])) {
        $errors[] = POSSIBLE_ERRORS['input-extension'];
    }
    if (!validateImageExtensions($payload[OUTPUT_FILE])) {
        $errors[] = POSSIBLE_ERRORS['output-extension'];
    }
    if (!empty($payload[WATERMARK]) && !validateImageExtensions($payload[WATERMARK])) {
        $errors[] = POSSIBLE_ERRORS['watermark-extension'];
    }

    if (!validateMimeType($payload[INPUT_FILE])) {
        $errors[] = POSSIBLE_ERRORS['input-mime-type'];
    }
    if (!empty($payload[WATERMARK]) && !validateMimeType($payload[WATERMARK])) {
        $errors[] = POSSIBLE_ERRORS['watermark-mime-type'];
    }




    return $errors;
}