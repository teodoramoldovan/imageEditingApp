<?php

require('validation.php');
require('inputProcessing.php');

ini_set('display_errors', 'ON');
session_start();

$errors = validateEmptyFieldsInUploadPhotoForm();

$userInsertedData = extractInputFieldsInArray();

$errors2 = !empty($userInsertedData)
    ? validateCorrectInputInUploadPhotoForm($userInsertedData)
    : [];
$errors = array_merge($errors2, $errors);
if (empty($errors)) {

    $pathToInsertedData = processUploadPhotoFormInput($userInsertedData);

    if (!empty($pathToInsertedData)) {
        $_SESSION['path'] = $pathToInsertedData;
        header("Location:successPage.php");
    }
}


?>

<!DOCTYPE html>

<html lang="en">
<head>
    <title>ShareMyArt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="resources/css/styles.css">

</head>

<body>
<div id="wrapper">

    <header>
        <div><img src="resources/logo.png" WIDTH=200></div>

    </header>


    <div class="container">


        <form action="" method="post" enctype="multipart/form-data" class="form-upload">

            <h1 class="form-upload-heading">Upload Photo</h1>

            <label for="image_title" class="form-upload-label">Image title</label>
            <input id="image_title" type="text"
                   name="imageTitle" class="form-control"
                   value="<?php echo isset($_POST[IMAGE_TITLE]) ? $_POST[IMAGE_TITLE] : '' ?>"/>

            <?php if (isset($_POST) && $errors && array_key_exists(IMAGE_TITLE_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[IMAGE_TITLE_ERROR] ?></div>
            <?php } ?>


            <br/>
            <label for="image_description" class="form-upload-label">Description</label><br/>
            <input id="image_description" type="text" name="imageDescription" class="form-control"
                   value="<?php echo isset($_POST[IMAGE_DESCRIPTION]) ? $_POST[IMAGE_DESCRIPTION] : '' ?>"/>

            <?php if (isset($_POST) && $errors && array_key_exists(IMAGE_DESCRIPTION_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[IMAGE_DESCRIPTION_ERROR] ?></div>
            <?php } ?>


            <br/>
            <label for="email" class="form-upload-label">Email</label><br/>
            <input id="email" type="email" name="artistEmail" class="form-control"
                   value="<?php echo isset($_POST[ARTIST_EMAIL]) ? $_POST[ARTIST_EMAIL] : '' ?>"/>

            <?php if (isset($_POST) && $errors && array_key_exists(ARTIST_EMAIL_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[ARTIST_EMAIL_ERROR] ?></div>
            <?php } ?>


            <br/>
            <label for="name" class="form-upload-label">Name</label><br/>
            <input id="name" type="text" name="artistName" class="form-control"
                   value="<?php echo isset($_POST[ARTIST_NAME]) ? $_POST[ARTIST_NAME] : '' ?>"/>

            <?php if (isset($_POST) && $errors && array_key_exists(ARTIST_NAME_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[ARTIST_NAME_ERROR] ?></div>
            <?php } ?>


            <br/>
            <label for="cameraSpecs" class="form-upload-label">Camera specifications</label><br/>
            <input id="cameraSpecs" type="text" name="cameraSpecifications" class="form-control"
                   value="<?php echo isset($_POST[CAMERA_SPECIFICATIONS]) ? $_POST[CAMERA_SPECIFICATIONS] : '' ?>"/>

            <?php if (isset($_POST) && $errors && array_key_exists(CAMERA_SPECIFICATIONS_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[CAMERA_SPECIFICATIONS_ERROR] ?></div>
            <?php } ?>


            <br/>
            <label for="price" class="form-upload-label">Price</label><br/>
            <input id="price" type="number" name="price" class="form-control" step="0.01" min="0"
                   value="<?php echo isset($_POST[PRICE]) ? $_POST[PRICE] : '' ?>"/>

            <?php if (isset($_POST) && $errors && array_key_exists(PRICE_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[PRICE_ERROR] ?></div>
            <?php } ?>


            <br/>
            <label for="date" class="form-upload-label">Capture date</label><br/>
            <input id="date" type="date" name="captureDate" class="form-control"
                   value="<?php echo isset($_POST[CAPTURE_DATE]) ? $_POST[CAPTURE_DATE] : '' ?>"/>

            <?php if (isset($_POST) && $errors && array_key_exists(CAPTURE_DATE_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[CAPTURE_DATE_ERROR] ?></div>
            <?php } ?>


            <br/>
            <br/>
            <label for="tags" class="form-upload-label">Tags</label><br/>
            <select multiple id="tags" class="form-control" name="tags[]">
                <?php foreach (VALID_TAGS as $tag) { ?>
                    <option value="<?php echo $tag ?>"> <?php echo $tag ?></option>
                <?php } ?>
            </select>

            <?php if (isset($_POST) && $errors && array_key_exists(TAGS_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[TAGS_ERROR] ?></div>
            <?php } ?>


            <br/>
            <br/>
            <label class="form-upload-label">Image</label><br/>
            <input type="file" multiple="multiple" name="image" class="form-control"/>

            <?php if (isset($_FILES) && $errors && array_key_exists(IMAGE_UPLOAD_ERROR, $errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $errors[IMAGE_UPLOAD_ERROR] ?></div>
            <?php } ?>

            <br/>
            <br/>
            <br/>
            <input type="submit" class="btn btn-info btn-lg btn-block" value="Upload image"/>
        </form>
    </div>

    <div style="clear: both;"></div>
</div>


</body>
</html>
