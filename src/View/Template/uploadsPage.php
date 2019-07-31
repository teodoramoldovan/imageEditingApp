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


<div class="row">
    <?php foreach ($this->uploads as $product){?>

        <div class="col-md-4">
            <div class="thumbnail">

                <img src=<?php echo self::UPLOADS_FOLDER_ROOT.$product->getThumbnailPath();?> alt="Lights" style="width:100%">
                <div class="caption">
                    <p style="color:white"><?php echo $product->getTitle();?></p>
                </div>

            </div>
        </div>

    <?php } ?>
</div>
</body>

</html>