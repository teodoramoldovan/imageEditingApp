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
    <?php foreach ($this->tiers as $tier){?>

        <div class="col-md-4">
            <div class="thumbnail">

                <img src=<?php echo self::UPLOADS_FOLDER_ROOT.$tier->getImagePathWithWatermark();?> >
                <div class="caption">
                    <p style="color:white"> <?php echo $tier->getPrice();?></p>
                </div>

            </div>

        </div>

    <?php } ?>
</div>

<form class="form-upload" method="post" action="/product/buy">

    <div class="form-group">


        <input type="radio" name="Size" value="s" style="color:white"> Small <br />
        <input type="radio" name="Size" value="m" style="color:white"> Medium <br />
        <input type="radio" name="Size" value="l" style="color:white"> Large <br />

    </div>

    <button class="btn btn-lg btn-primary btn-block form-group" type="submit" formnovalidate>
        Buy
    </button>
</form>
</body>

</html>