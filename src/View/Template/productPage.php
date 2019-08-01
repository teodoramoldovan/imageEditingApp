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
<div class="form-upload" style="max-width: 100%">
    <p style="color:white "> Product title: <?php echo $this->product->getTitle(); ?></p>
    <p style="color:white "> Description: <?php echo $this->product->getDescription(); ?></p>
    <p style="color:white "> Camera specifications: <?php echo $this->product->getCameraSpecifications(); ?></p>
    <p style="color:white "> Capture date: <?php echo $this->product->getCaptureDate()->format("Y-m-d"); ?></p>


    <?php foreach ($this->product->getTags() as $tag) { ?>
        <span class="badge" style="color: black; background-color: aquamarine">
            <?php echo '#' . $tag->getTagName(); ?>
        </span>
    <?php } ?>
</div>

<div class="row form-upload" style="max-width: 100%">
    <?php foreach ($this->tiers as $tier) { ?>

        <div class="col-md-4" align="center">


            <img style="max-width: 400px;"
                 src=<?php echo self::UPLOADS_FOLDER_ROOT . $tier->getImagePathWithWatermark(); ?>>
            <div class="caption">
                <p style="color:white "> Price: <?php echo $tier->getPrice(); ?> EUR</p>
            </div>


        </div>

    <?php } ?>
</div>

<form class="form-upload" method="post" action="/product/buy">

    <div class="form-group" align="center">


        <div class="radio">

            <?php if (false === array_search($this->tiers[0]->getId(), $this->boughtTierIds)) { ?>
                <label style="color:white">
                    <input type="radio" name="size"
                           value="<?php echo $this->tiers[0]->getImagePathWithoutWatermark(); ?>"
                           checked>Small
                </label>
            <?php } ?>
            <input type="hidden" name="smallTierId" value="<?php echo $this->tiers[0]->getId(); ?>">
        </div>


        <div class="radio">
            <?php if (false === array_search($this->tiers[1]->getId(), $this->boughtTierIds)) { ?>
                <label style="color:white">
                    <input type="radio" name="size"
                           value="<?php echo $this->tiers[1]->getImagePathWithoutWatermark(); ?>" checked>
                    Medium
                </label>
            <?php } ?>
            <input type="hidden" name="mediumTierId" value="<?php echo $this->tiers[1]->getId(); ?>">
        </div>
        <div class="radio">
            <?php if (false === array_search($this->tiers[2]->getId(), $this->boughtTierIds)) { ?>
                <label style="color:white">
                    <input type="radio" name="size"
                           value="<?php echo $this->tiers[2]->getImagePathWithoutWatermark(); ?>" checked>
                    Original
                </label>
            <?php } ?>
            <input type="hidden" name="largeTierId" value="<?php echo $this->tiers[2]->getId(); ?>">
        </div>

    </div>

    <button class="btn btn-lg btn-primary btn-block form-group" type="submit" formnovalidate>
        Buy
    </button>
</form>
</body>

</html>