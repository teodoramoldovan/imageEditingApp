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

<h1 style="color: white">My Uploads</h1>
<div class="row form-upload" style="max-width: 100%">

    <?php if (empty($this->uploads)) { ?>
        <h1 style="color: white" >You haven't uploaded anything yet</h1>
    <?php } ?>

    <?php foreach ($this->uploads as $product) { ?>

        <div class="col-md-4">
            <div class="thumbnail">

                <img style="max-width: 300px; max-height: 200px"
                     src=<?php echo self::UPLOADS_FOLDER_ROOT . $product->getThumbnailPath(); ?> alt="Lights"
                     >
                <div class="caption">
                    <p style="color:white"><?php echo $product->getTitle(); ?></p>
                </div>

            </div>
        </div>

    <?php } ?>
</div>
</body>

</html>