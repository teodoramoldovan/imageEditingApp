<?php
require_once "constants.php";

/**
 * Will validate if the fields in the form are not empty
 *
 * @return array containing errors found, if any
 */
function validateEmptyFieldsInUploadPhotoForm():array
{

    $errors = [];

    if ($_POST) {

        if (!$_POST[IMAGE_TITLE ]) {
            $errors[IMAGE_TITLE_ERROR] = IMAGE_TITLE_EMPTY_ERROR_TEXT;
        }
        if (!$_POST[IMAGE_DESCRIPTION]) {
            $errors[IMAGE_DESCRIPTION_ERROR] = IMAGE_DESCRIPTION_EMPTY_ERROR_TEXT;
        }
        if (!$_POST[ARTIST_EMAIL]) {
            $errors[ARTIST_EMAIL_ERROR] = ARTIST_EMAIL_EMPTY_ERROR_TEXT;
        }
        if (!$_POST[ARTIST_NAME]) {
            $errors[ARTIST_NAME_ERROR] = ARTIST_NAME_EMPTY_ERROR_TEXT;
        }
        if (!$_POST[CAMERA_SPECIFICATIONS]) {
            $errors[CAMERA_SPECIFICATIONS_ERROR] = CAMERA_SPECIFICATIONS_EMPTY_ERROR_TEXT;
        }
        if (!$_POST[PRICE]) {
            $errors[PRICE_ERROR] = PRICE_EMPTY_ERROR_TEXT;
        }
        if (!$_POST[CAPTURE_DATE]) {
            $errors[CAPTURE_DATE_ERROR] = CAPTURE_DATE_EMPTY_ERROR_TEXT;
        }
        if (!array_key_exists(TAGS,$_POST) || !$_POST[TAGS]) {
            $errors[TAGS_ERROR] = TAGS_EMPTY_ERROR_TEXT;
        }
        if(!$_FILES[IMAGE][IMAGE_NAME]){
            $errors[IMAGE_UPLOAD_ERROR]=IMAGE_UPLOAD_EMPTY_ERROR_TEXT;
        }

    }

    return $errors;
}

/**
 * @param string $email
 * @return bool
 */
function isEmailValid(string $email):bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);

}

/**
 * @param string $date
 * @return bool
 * @throws Exception
 */
function isDateValid(string $date):bool
{
    $date=new DateTime($date);
    $currentDate=new DateTime();

    if($date<=$currentDate){
        return true;
    }
    return false;
}

/**
 * Will check if the price is numeric and positive
 *
 * @param string $price
 * @return bool
 */
function isPriceValid(string $price):bool
{
    return is_numeric($price) && (float)$price>0;
}

/**
 * Will check if the selected tags are some from the list provided
 *
 * @param array $tags
 * @return bool
 */
function areTagsValid(?array $tags):bool
{
    foreach ($tags as $tagItem){
        if(!in_array($tagItem,VALID_TAGS)){
            return false;
        }
    }
    return true;
}


/**
 * Will validate the user inserted data if there are no empty fields
 *
 * @param array $userInsertedData
 * @return array
 * @throws Exception
 */
function validateCorrectInputInUploadPhotoForm(array $userInsertedData):array
{
    $errors=[];

    if(array_key_exists(ARTIST_EMAIL, $userInsertedData) && !isEmailValid($userInsertedData[ARTIST_EMAIL])){
        $errors[ARTIST_EMAIL_ERROR]=ARTIST_EMAIL_ERROR_TEXT;
    }
    if(array_key_exists(PRICE, $userInsertedData) && !isPriceValid($userInsertedData[PRICE])){
        $errors[PRICE_ERROR]=PRICE_ERROR_TEXT;
    }
    if(array_key_exists(CAPTURE_DATE, $userInsertedData) && !isDateValid($userInsertedData[CAPTURE_DATE])){
        $errors[CAPTURE_DATE_ERROR]=CAPTURE_DATE_ERROR_TEXT;
    }
    if(array_key_exists(TAGS, $userInsertedData) && !areTagsValid($userInsertedData[TAGS])){
        $errors[TAGS_ERROR]=TAGS_ERROR_TEXT;
    }

    return $errors;
}

