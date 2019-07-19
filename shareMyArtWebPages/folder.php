<?php
//astea altundeva: createFolder, verify if user folder exists
function createFolder(string $hashedFolderName):void
{
    mkdir(UPLOADS_FOLDER_ROOT.$hashedFolderName);

}

function verifyIfUserFolderAlreadyExists(string $hashedFolderName):bool
{
    $uploadsFolderContent=scandir(UPLOADS_FOLDER_ROOT);
    if(array_search($hashedFolderName,$uploadsFolderContent)){
        return true;
    }
    return false;
}

/**
 * Will call a function that searches for the folder in the uploads root folder
 * and if it doesn't exist it will call a function to create it
 *
 * @return string contains hashed name of the user's folder
 */
function findUserFolder(string $hashedFolderName):string
{
    if(!verifyIfUserFolderAlreadyExists($hashedFolderName)){
        createFolder($hashedFolderName);
    }
    return $hashedFolderName;
}