<?php
require_once "constants.php";

function validateUploadPhotoForm():array
{

    $errors = [];

    if ($_POST) {

        if (!$_POST[IMAGE_TITLE ]) {
            $errors[IMAGE_TITLE_ERROR] = IMAGE_TITLE_ERROR_TEXT;
        }
        if (!$_POST[IMAGE_DESCRIPTION]) {
            $errors[IMAGE_DESCRIPTION_ERROR] = IMAGE_DESCRIPTION_ERROR_TEXT;
        }
        if (!$_POST[ARTIST_EMAIL]) {
            $errors[ARTIST_EMAIL_ERROR] = ARTIST_EMAIL_ERROR_TEXT;
        }
        if (!$_POST[ARTIST_NAME]) {
            $errors[ARTIST_NAME_ERROR] = ARTIST_NAME_ERROR_TEXT;
        }
        if (!$_POST[CAMERA_SPECIFICATIONS]) {
            $errors[CAMERA_SPECIFICATIONS_ERROR] = CAMERA_SPECIFICATIONS_ERROR_TEXT;
        }
        if (!$_POST[PRICE]) {
            $errors[PRICE_ERROR] = PRICE_ERROR_TEXT;
        }
        if (!$_POST[CAPTURE_DATE]) {
            $errors[CAPTURE_DATE_ERROR] = CAPTURE_DATE_ERROR_TEXT;
        }


        //TODO:move this somewhere else
        $email = $_POST[ARTIST_EMAIL];
        $emailValidationOutput=validateEmail($email);
        if(!empty($emailValidationOutput)){
            $errors[]=$emailValidationOutput;
        }


    }
    var_dump($errors);
    return $errors;
}

function validateEmail(string $email):string
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        return 'Incorrect email address';
    }
    return '';
}



