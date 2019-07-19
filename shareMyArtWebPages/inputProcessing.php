<?php

require_once "constants.php";
require_once "folder.php";

function processUploadPhotoFormInput()
{
    if($_POST){
        //extract input form fields in array
        $userInsertedData=extractInputFieldsInArray();

        //TODO: input validations other than empty

        $userFolderName=findUserFolder(md5($userInsertedData[ARTIST_NAME]));


        saveImageInUserFolder($userFolderName);
        saveInputFieldsAsJson($userInsertedData,$userFolderName);
    }


}

function extractInputFieldsInArray()
{
    foreach ($_POST as $key=>$value){
        $userInsertedData[$key]=$value;
    }
     $userInsertedData[IMAGE_NAME]=(count($_FILES))?$_FILES[IMAGE][IMAGE_NAME]:'';
    return $userInsertedData;
}

function saveImageInUserFolder(string $userFolderName):void
{
    if (count($_FILES)) {
           move_uploaded_file($_FILES[IMAGE][TEMPORARY_FILE_LOCATION], UPLOADS_FOLDER_ROOT.$userFolderName.'/'.$_FILES[IMAGE][IMAGE_NAME]);

    }
}

function saveInputFieldsAsJson(array $userInsertedData,string $userFolderName):void
{
    $jsonData=json_encode($userInsertedData);

    //aici ar trebui sa pun cumva sa se fac nume daca is mai multe
    file_put_contents(UPLOADS_FOLDER_ROOT.$userFolderName.'/myfile.json', $jsonData);
}

