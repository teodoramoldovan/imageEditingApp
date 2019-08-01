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
    <link rel="stylesheet" type="text/css" href="../../../css/styles.css">

</head>

<body>
<div id="wrapper">

    <div class="container">

        <?php var_dump(isset($_POST['image']));?>

        <form action="/product/uploadPost" method="post" enctype="multipart/form-data" class="form-upload">

            <h1 class="form-upload-heading">Upload Photo</h1>

            <label for="image_title" class="form-upload-label">Image title</label>
            <input id="image_title" type="text"
                   name="imageTitle" class="form-control"
                   value="<?php echo isset($_POST['imageTitle']) ? $_POST['imageTitle'] : '' ?>"/>

            <?php if (isset($_POST) && $this->errors && array_key_exists('imageTitleError', $this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['imageTitleError'] ?></div>
            <?php } ?>


            <br/>
            <label for="image_description" class="form-upload-label">Description</label><br/>
            <input id="image_description" type="text" name="imageDescription" class="form-control"
                   value="<?php echo isset($_POST['imageDescription']) ? $_POST['imageDescription'] : '' ?>"/>

            <?php if (isset($_POST) && $this->errors && array_key_exists('imageDescriptionError', $this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['imageDescriptionError'] ?></div>
            <?php } ?>


            <br/>
            <label for="cameraSpecs" class="form-upload-label">Camera specifications</label><br/>
            <input id="cameraSpecs" type="text" name="cameraSpecifications" class="form-control"
                   value="<?php echo isset($_POST['cameraSpecifications']) ? $_POST['cameraSpecifications'] : '' ?>"/>

            <?php if (isset($_POST) && $this->errors && array_key_exists('cameraSpecificationsError', $this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['cameraSpecificationsError'] ?></div>
            <?php } ?>


            <br/>
            <label for="price" class="form-upload-label">Price</label><br/>
            <input id="price" type="number" name="price" class="form-control" step="0.01" min="0"
                   value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>"/>

            <?php if (isset($_POST) && $this->errors && array_key_exists('priceError', $this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['priceError'] ?></div>
            <?php } ?>


            <br/>
            <label for="date" class="form-upload-label">Capture date</label><br/>
            <input id="date" type="date" name="captureDate" class="form-control"
                   value="<?php echo isset($_POST['captureDate']) ? $_POST['captureDate'] : '' ?>"/>

            <?php if (isset($_POST) && $this->errors && array_key_exists('captureDateError', $this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['captureDateError'] ?></div>
            <?php } ?>


            <br/>
            <br/>
            <label for="tags" class="form-upload-label">Tags</label><br/>
            <select multiple id="tags" class="form-control" name="tags[]">
                <option value="" selected="selected"> No tags for me this time, thanks</option>

                <?php foreach ($this->tags as $tag) { ?>
                    <option value="<?php echo $tag->getTagName(); ?>"> <?php echo $tag->getTagName(); ?></option>
                <?php } ?>
            </select>

            <?php if (isset($_POST) && $this->errors && array_key_exists('tagsError', $this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['tagsError'] ?></div>
            <?php } ?>


            <br/>
            <br/>
            <label class="form-upload-label">Image</label><br/>
            <input type="file" multiple="multiple" name="image" class="form-control"/>

            <?php if (isset($_FILES) && $this->errors && array_key_exists('noFileUploadedError', $this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['noFileUploadedError'] ?></div>
            <?php } ?>

            <br/>
            <?php if (isset($_POST) && $this->errors && array_key_exists('emptyFieldsError',$this->errors)) { ?>
                <div style="color: rgb(204, 0, 0)"><?php echo $this->errors['emptyFieldsError'] ?></div>
            <?php } ?>
            <br/>
            <br/>
            <input type="submit" class="btn btn-info btn-lg btn-block" value="Upload image"/>
        </form>
    </div>

    <div style="clear: both;"></div>
</div>


</body>
</html>
