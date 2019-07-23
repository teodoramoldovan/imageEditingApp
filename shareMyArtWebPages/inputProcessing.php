<?php

require_once "constants.php";
require_once "folder.php";
require_once "validation.php";

/**
 * Will save the file and the photo in the user folder
 *
 * @param array $userInsertedData
 * @return string
 */
function processUploadPhotoFormInput(array $userInsertedData): string
{

    $pathToInsertedData = "";

    if ($_POST) {

        $userFolderName = findUserFolder(md5($userInsertedData[ARTIST_NAME]));
        saveImageInUserFolder($userInsertedData, $userFolderName);
        $pathToInsertedData = saveInputFieldsAsJson($userInsertedData, $userFolderName);
    }

    return $pathToInsertedData;
}


/**
 * @return array containing the data extracted from the array
 */
function extractInputFieldsInArray(): array
{
    $userInsertedData = [];
    if ($_POST) {

        foreach ($_POST as $key => $value) {
            $userInsertedData[$key] = $value;
        }
        $userInsertedData[IMAGE_NAME] = (count($_FILES)) ? $_FILES[IMAGE][IMAGE_NAME] : '';
        $userInsertedData[SAVED_IMAGE_NAME] = (count($_FILES)) ? time() . $_FILES[IMAGE][IMAGE_NAME] : '';

    }

    return $userInsertedData;
}

/**
 * @param string $userFolderName
 */
function saveImageInUserFolder(array $userInsertedData, string $userFolderName): void
{
    if (count($_FILES)) {
        move_uploaded_file($_FILES[IMAGE][TEMPORARY_FILE_LOCATION],
            UPLOADS_FOLDER_ROOT . $userFolderName . '/' . $userInsertedData[SAVED_IMAGE_NAME]);
    }
}

/**
 * @param array $userInsertedData
 * @param string $userFolderName
 * @return string contains the path where the file is saved
 */
function saveInputFieldsAsJson(array $userInsertedData, string $userFolderName): string
{
    $jsonData = json_encode($userInsertedData);
    $pathToInsertedData = UPLOADS_FOLDER_ROOT . $userFolderName . '/myfile' . time() . 'json';

    file_put_contents($pathToInsertedData, $jsonData);

    return $pathToInsertedData;
}
