<?php

require ('validation.php');
require ('inputProcessing.php');
ini_set('display_errors', 'ON');
$errors=validateUploadPhotoForm();

if(empty($errors)){
    processUploadPhotoFormInput();
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <title>ShareMyArt</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<div id="wrapper">

    <div class="content">
        <h1>Upload Photo</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="image_title">Image title</label><br />
            <input id="image_title" type="text" value="" name="imageTitle" />
            <span class="error"><br />
                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo $errors[IMAGE_TITLE_ERROR] ?></div>
                <?php } ?>

            </span>

            <br />
            <label for="image_description">Description</label><br />
            <input id="image_description" type="text" value="" name="imageDescription" />
            <span class="error"><br />
                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo $errors[IMAGE_DESCRIPTION_ERROR] ?></div>
                <?php } ?>

            </span>

            <br />
            <label for="email">Email</label><br />
            <input id="email" type="email" value="" name="artistEmail" />
            <span class="error"><br />
                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo $errors[ARTIST_EMAIL_ERROR] ?></div>
                <?php } ?>

            </span>

            <br />
            <label for="name">Name</label><br />
            <input id="name" type="text" value="" name="artistName" />
            <span class="error"><br />
                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo $errors[ARTIST_NAME_ERROR] ?></div>
                <?php } ?>

            </span>

            <br />
            <label for="cameraSpecs">Camera specifications</label><br />
            <input id="cameraSpecs" type="text" value="" name="cameraSpecifications" />
            <span class="error"><br />
                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo $errors[CAMERA_SPECIFICATIONS_ERROR] ?></div>
                <?php } ?>

            </span>

            <br />
            <label for="price">Price</label><br />
            <input id="price" type="number" value="" name="price" />
            <span class="error"><br />
                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo $errors[PRICE_ERROR] ?></div>
                <?php } ?>

            </span>

            <br />
            <label for="date">Capture date</label><br />
            <input id="date" type="date" value="" name="captureDate" />
            <span class="error"><br />
                <?php if (isset($_POST) && $errors) {?>
                    <div style="color: red"><?php echo $errors[CAPTURE_DATE_ERROR] ?></div>
                <?php } ?>

            </span>

            <br />
            <br />
            <!--de mutat intr-o constanta sau ceva -->
            <label for="tags">Tags</label><br />
            <select multiple id="tags">
                <option value="nature">Nature</option>
                <option value="sunset">Sunset</option>
                <option value="grayscale">Grayscale</option>
                <option value="highContrast">High contrast</option>
            </select>


            <br />
            <br />
            Image<br />
            <input type="file" multiple="multiple" name="image" />

            <br />
            <br />
            <br />
            <input type="submit" value="Upload image" />
        </form>
    </div>

    <div style="clear: both;"></div>
</div>



</body>
</html>
